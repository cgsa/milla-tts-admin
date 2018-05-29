<?php
class OperacionesClasificacion
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
            case 'U':
                $this->insertarDatos();
            break;
            case 'D':
            break;
        }
        
        return $this;
    }
    
    
    private function insertarDatos()
    {
        $result = 0;
        
        if(isset($this->sessionPost['ClasificacionDeudores']))
        {
            $this->model->attributes = $this->sessionPost['ClasificacionDeudores'];
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
                $this->result['formulario'] = $this->controler->render('clasificacion/_form',array(
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
        $this->model = new ClasificacionDeudores;
        
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
    
}