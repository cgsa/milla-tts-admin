<?php
class OperacionesConfiguracion
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
            case 'E':
            case 'U':
                $this->cofiguracionEtiquetas();
            break;
        }
        
        return $this;
    }
    
    
    private function cofiguracionEtiquetas()
    {
        $result = 0;
        
        if(isset($this->sessionPost['EtiquetasCamposAdicionales']))
        {
            $this->model->attributes = $this->sessionPost['EtiquetasCamposAdicionales'];
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
                $this->result['formulario'] = $this->controler->render('configuracion/_form',array(
                                                'model'=>$this->model,
                                                'action'=>$this->operacion,
                                                'entidad'=>$this->sessionPost['entidad']
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
        $this->model = new EtiquetasCamposAdicionales;
        
        switch ($this->operacion)
        {
            case 'E':
                if(is_numeric($this->sessionPost['entidad']))
                {
                    $criteria=new CDbCriteria;
                    $criteria->condition = "identidad = ".$this->sessionPost['entidad'];
                    $this->model = $this->model->find($criteria);
                    
                    if(is_null($this->model))
                    {
                        $this->registrarEtiquetas();
                        
                    }
                }
            break;
            case 'U':                
                if(is_numeric($this->sessionPost['id']))
                {
                    $this->model = $this->model->findByPk($this->sessionPost['id']);
                }
            break;
        }
    }
    
    
    
    private function registrarEtiquetas()
    {
        $this->model = new EtiquetasCamposAdicionales;
        $this->model->identidad = (int)$this->sessionPost['entidad'];
        $this->model->save();        
    }
    
    
}