<?php
class OperacionesAgentes
{
    
    private $operacion;
    
    private $sessionPost;
    
    private $model;
    
    public $vista;
    
    public $error;
    
    public $controler;
    
    
    
    public $result = array();
    
    
    
    public function __construct($controlador)
    {
        if(isset($_POST) && is_object($controlador))
        {
            $this->operacion = $_POST['action'];
            $this->sessionPost = $_POST;            
            $this->controler = $controlador;
            $this->cargarModelo();
        }
        else
        {
            throw new Exception("Faltan parametros para inicializar las operaciones.");
        }        
        
    }
    
    
    public function init()
    {
        switch ($this->operacion)
        {
            case 'I':
                $this->insertarDatosAgentes();
            break;
            case 'U':
                $this->actualizarDatosAgentes();
            break;
            case 'D':
            break;
        }
        
        return $this;
    }
    
    
    private function insertarDatosAgentes()
    {
        $result = 0;
        
        if(isset($this->sessionPost['UsrUsuariosAgentes']))
        {
            $this->model->attributes = $this->sessionPost['UsrUsuariosAgentes'];
            $this->model->username = $this->sessionPost['UsrUsuariosAgentes']['username'];
            $this->model->fecha_carga = date('Y-m-d');
            $result = -1;
            
            if($this->registrarUsuarioSistema())
            {
                if($this->model->save())
                {
                    $result = 1;
                }
            }
            
        }
        
        $this->prepararResultado($result);
    }
    
    
    private function actualizarDatosAgentes()
    {
        $result = 0;
        
        if(isset($this->sessionPost['UsrUsuariosAgentes']))
        {
            $this->model->attributes = $this->sessionPost['UsrUsuariosAgentes'];
            $result = -1;
            
            if($this->model->save())
            {
                $result = 1;
            }
            
        }
        
        $this->prepararResultado($result);
    }
    
    
    private function prepararResultado($r)
    {
        $this->result['status'] = true;  
        
        switch ($r) {
            case 1:
                $this->result['mensaje'] = "El registro se realizó de manera satisfactoria.";
            break;
            case 0:
                $this->result['formulario'] = $this->controler->render('usrUsuariosAgentes/_form',array(
                                                'model'=>$this->model,
                                                'action'=>$this->operacion,
                                                'id'=>$this->sessionPost['id']
                                                ),true);
            break;            
            case -1:
            default:
                $errores = CHtml::errorSummary($this->model);
                $this->result['status'] = false;
                $this->result['mensaje'] = $errores;
            break;
        }
    }
    
    
    private function cargarModelo()
    {
        $this->model = new UsrUsuariosAgentes;
        
        switch ($this->operacion)
        {
            case 'U':
            case 'D':
            if(is_numeric($this->sessionPost['id']))
            {
                $this->model = $this->model->findByPk($this->sessionPost['id']);
            }
            break;
        }
    }
    
    
    
    private function registrarUsuarioSistema()
    {
        // asi se crea un usuario (una nueva instancia en memoria volatil)
        $model = Yii::app()->user->um->createBlankUser();
        $model->username = $this->model->username;
        $model->email = $this->model->email;
        // verifica para no duplicar
        if(Yii::app()->user->um->loadUser($model->username) != null)
        {
            throw new Exception("El usuario {$model->username} ya ha sido creado.");
        }
        else
        {
            // ponerle una clave
            Yii::app()->user->um->changePassword($model,$this->model->password);
            Yii::app()->user->um->generateAuthenticationKey($model);
            // guarda usando el API, la cual hace pasar al usuario por el sistema de filtros.
            if(Yii::app()->user->um->save($model)){
                //$update = $this->loadModel($model->id);
                // la establece como "Activada"
                Yii::app()->user->um->activateAccount($model);
                $this->model->id = $model->getPrimaryKey();
                //die($urlActivacion);
                $this->onNewUser($model, $this->model->password,"","USER-AGENTE");
            }
            else{
                $errores = CHtml::errorSummary($model);
                throw new Exception("no se pudo crear el usuario: ".$errores);
            }
            
        }
        
        return true;
    }
    
    
    
    public function actualizarUsuarioSistema()
    {
        $model = Yii::app()->user->um->loadUserById($this->model->id,true);
        
    }
    
    /* este es un evento emitido por actionRegistration y actionUserManagementCreate
     el cual informa que un nuevo usuario ha sido creado.
     
     segun la configuracion general del sistema este usuario
     sera activado de inmediato, o por email, o manualmente.
     */
    private function onNewUser(ICrugeStoredUser $model, $newPwd = "", $url = "",$role = "")
    {
        Yii::log(__METHOD__ . "\n", "info");
        
        //$opt = Yii::app()->user->um->getDefaultSystem()->getn("registerusingactivation");
        
        $role = ($role != "")? $role : Yii::app()->user->um->getDefaultSystem()->get("defaultroleforregistration");
        Yii::log(__METHOD__ . "\n role: " . $role, "info");
        if (Yii::app()->user->rbac->getAuthItem($role) != null) {
            Yii::log(
                __METHOD__ . "\n asignando role: " . $role . " a userid:"
                . $model->getPrimaryKey(),
                "info"
                );
            Yii::app()->user->rbac->assign($role, $model->getPrimaryKey());
        }
        
        
        $bodyMensaje = $this->controler->renderPartial('../registroNuevoUsuario/correoactivacion',array(
            'enlace'=> $url,
            'contenido'=>"Ha sido registrado correctamente en el sistema cancelo mi deuda.",
        ), true);
        
        $this->sendMessage($model->email, $bodyMensaje);
    }
    
    
    private function sendMessage( $email,$body)
    {
        Yii::import('application.extensions.phpmailer.JPhpMailer');
        
        $mail = new JPhpMailer;
        $mail->IsSMTP();
        $mail->Host = 'ssl://smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->Username = 'edwin.zapata@contactogarantido.com';
        $mail->Password = 'garantido414';
        $mail->CharSet = 'utf-8';
        $mail->SMTPDebug  = 0;
        $mail->SetFrom('edwin.zapata@contactogarantido.com', 'Registro Cancelo Mi Deuda');
        $mail->Subject = 'Activación Cuenta Cancelo Mi Deuda';
        $mail->AltBody = 'Activación Cuenta Cancelo Mi Deuda';
        $mail->MsgHTML($body);
        $mail->AddAddress($email, 'Registro Cancelo Mi Deuda');
        //$mail->AddBCC($email2,$config->titulo);
        return $mail->Send();
    }
    
}