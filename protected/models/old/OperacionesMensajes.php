<?php
class OperacionesMensajes
{
    
    private $operacion;
    
    private $sessionPost;
    
    private $model;
    
    public $vista;
    
    public $error;
    
    public $controler;
    
    private $comando;
    
    private $conexion;
    
    
    
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
            case 'R':
                $this->insertarDatosMensajes();
            break;
        }
        
        return $this;
    }
    
    
    private function insertarDatosMensajes()
    {
        $result = 0;
        
        if(isset($this->sessionPost['texto']))
        {
            $this->model->respuesta = $this->sessionPost['texto'];
            $this->model->fecha_respuesta = date('Y-m-d');
            $this->model->iduser = Yii::app()->user->id;
            $result = -1;
            
            if($this->model->save())
            {
                $result = 1;
            }
            
        }
        
        $this->prepararResultado($result);
    }
    
    
    private function insertarDatosMensajesUsuario()
    {
        $result = 0;
        
        if(isset($this->sessionPost['UsrMensajes']))
        {
            $this->model->attributes = $this->sessionPost['UsrMensajes'];
            $this->model->fecha_carga = date('Y-m-d');
            $this->model->estadomensaje = 0;
            $this->model->iduser = Yii::app()->user->id;
            $this->model->tipo = 1;
            $result = -1;
            
            if($this->model->save())
            {
                $result = 1;
            }
            
        }
        
        $this->prepararResultado($result);
    }
    
    
    private function actualizarDatosMensajes()
    {
        $result = 0;
        
        switch (isset($this->sessionPost['UsrMensajes'])) 
        {
            case 1:
                $this->model->attributes = $this->sessionPost['UsrMensajes'];
                $this->model->estadomensaje = 2;
                $result = -1; 
                if($this->model->save())
                {
                    $result = 1;
                }
            break;            
            default:
                if($this->model->tipo == 1 && $this->model->estadomensaje == 0)
                {
                    $this->model->estadomensaje = 1;
                    if($this->model->save())
                    {
                        $result = 0;
                    }
                }
            break;
        } 
        
        $this->prepararResultado($result);
    }
    
    
    private function actualizarDatosMensajesUsuarios()
    {
        $result = 0;
        
        switch (isset($this->sessionPost['UsrMensajes']))
        {
            case 1:
                $this->model->attributes = $this->sessionPost['UsrMensajes'];
                $this->model->estadomensaje = 2;
                $result = -1;
                if($this->model->save())
                {
                    $result = 1;
                }
                break;
            default:
                if($this->model->estadomensaje == 0 && $this->model->estadomensaje == 2)
                {
                    $this->model->estadomensaje = 4;
                    if($this->model->save())
                    {
                        $result = 0;
                    }
                }
                break;
        }
        
        $this->prepararResultado($result);
    }
    
    
    
    private function marcarMensajes()
    {
        $result = -1;
        
        if( count($this->sessionPost['datos']) > 0 )
        {
            $this->comando->bindValue(":estado", $this->sessionPost['estado']);
            foreach ($this->sessionPost['datos'] as $value)
            {
                $this->comando->bindValue(":idmensaje", $value);
                $this->comando->execute();
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
           /* case 0:
                $this->result['formulario'] = $this->controler->render('mensajes/_form',array(
                                                'model'=>$this->model,
                                                'action'=>$this->operacion,
                                                'id'=>$this->sessionPost['id']
                                                ),true);
            break;
            case 2:
                $this->result['formulario'] = $this->controler->render('usrMensajes/_view',array(
                'model'=>$this->model,
                'action'=>$this->operacion,
                'id'=>$this->sessionPost['id']
                ),true);
            break;
            case -1:*/
            default:
                $errores = CHtml::errorSummary($this->model);
                $this->result['status'] = false;
                $this->result['mensaje'] = $errores;
            break;
        }
    }
    
    
    private function cargarModelo()
    {
        $this->model = new MensajesInterno;
        
        switch ($this->operacion)
        {
            
            case 'R':
            if(is_numeric($this->sessionPost['id']))
            {
                $this->model = $this->model->findByPk($this->sessionPost['id']);
            }
            break;
            
        }
    }
    
    
    private function inciarComando()
    {
        $sql = "UPDATE usr_mensajes SET estadomensaje = :estado WHERE id = :idmensaje";
        $this->comando = $this->conexion->createCommand($sql);	
    }
    
    
    
    public function actualizarUsuarioSistema()
    {
        $model = Yii::app()->user->um->loadUserById($this->model->id,true);
        
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