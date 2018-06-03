<?php
class OperacionesDeudas
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
                //$this->insertarDatosMensajes();
            break;
            case 'IU':
                //$this->insertarDatosMensajesUsuario();
            break;
            case 'E':
                //$this->actualizarDatosMensajes();
            break;
            case 'DD':
                $this->actualizarDatosDeuda();
            break;
        }
        
        return $this;
    }
    
    
    private function insertarDatosMensajes()
    {
        $result = 0;
        
        if(isset($this->sessionPost['UsrDeudas']))
        {
            $this->model->attributes = $this->sessionPost['UsrDeudas'];
            $this->model->fecha_carga = date('Y-m-d');
            $this->model->estadomensaje = 0;
            $this->model->iduser = Yii::app()->user->id;
            $this->model->tipo = 0;
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
        
        if(isset($this->sessionPost['UsrDeudas']))
        {
            $this->model->attributes = $this->sessionPost['UsrDeudas'];
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
    
    
    private function actualizarDatosDeuda()
    {
        $result = 0;
        
        switch (isset($this->sessionPost['UsrDeudas'])) 
        {
            case 1:
                $this->model->attributes = $this->sessionPost['UsrDeudas'];
                $this->model->estadomensaje = 2;
                $result = -1; 
                if($this->model->save())
                {
                    $result = 1;
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
    
    
    private function prepararResultado($r)
    {
        $this->result['status'] = true;  
        
        switch ($r) {
            case 1:
                $this->result['mensaje'] = "El registro se realizó de manera satisfactoria.";
            break;
            case 0:
                $this->result['formulario'] = $this->controler->render('usrDeudasLotes/dialogodeuda',array(
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
        $this->model = new UsrDeudas;
        
        switch ($this->operacion)
        {
            case 'DD':
            if(is_numeric($this->sessionPost['id']))
            {
                $this->model = $this->model->findByPk($this->sessionPost['id']);
            }
            break;
        }
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
    
    /*$vista = "";
    $model = new UsrUsuariosAgentes;
    $id = "";
    if(isset($_POST))
    {
        switch ($_POST['action'])
        {
            case 'I':
                $vista = 'usrEntidades/_form';
                if(isset($_POST['UsrUsuariosAgentes']))
                {
                    $model->attributes=$_POST['UsrUsuariosAgentes'];
                    $model->fecha_carga = date('Y-m-d');
                    
                    if($model->save())
                    {
                        $up->saveFile();
                        header('Content-type: application/json');
                        $result['status'] = true;
                        $result['mensaje'] = "El registro se realizó de manera satisfactoria.";
                        die(json_encode($result));
                    }
                    else
                    {
                        $errores = CHtml::errorSummary($model);
                        throw new Exception($errores);
                    }
                    
                }
                break;
            case 'U':
                $vista = 'usrEntidades/_form';
                $id = $_POST['id'];
                if(is_numeric($id))
                {
                    $model = $model->findByPk($id);
                    if(isset($_POST['UsrEntidades']))
                    {
                        $oldName = $model->logo;
                        $model->attributes=$_POST['UsrEntidades'];
                        
                        $up = new ClassUploadFile($model, 'filename');
                        $model->logo = $up->filename;
                        
                        if($model->save())
                        {
                            $up->saveFile(0,$oldName);
                            header('Content-type: application/json');
                            $result['status'] = true;
                            $result['mensaje'] = "El registro se realizó de manera satisfactoria.";
                            die(json_encode($result));
                        }
                        else
                        {
                            $errores = CHtml::errorSummary($model);
                            throw new Exception($errores);
                        }
                        
                    }
                }
                break;
            case 'D':
                $id = $_POST['id'];
                if(is_numeric($id))
                {
                    $model = $model->findByPk($id);
                    $oldName = $model->logo;
                    $up = new ClassUploadFile($model, 'filename');
                    $up->deleteFile($oldName);
                    $model->delete();
                    header('Content-type: application/json');
                    $result['status'] = true;
                    $result['mensaje'] = "La operación se realizó con éxito.";
                    die(json_encode($result));
                }
                else
                {
                    throw new Exception('Se produjó un error al realizar la operación.');
                }
                break;
        }
        
        $result['status'] = true;
        $result['formulario'] = $this->renderPartial($vista,array(
            'model'=>$model,
            'action'=>$_POST['action'],
            'id'=>$id
        ),true);
        
        
    }
    else
    {
        throw new Exception('La vista que intenta acceder no existe.');
    }*/
}