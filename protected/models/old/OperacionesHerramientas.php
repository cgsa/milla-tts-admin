<?php
class OperacionesHerramientas
{
    
    private $operacion;
    
    private $operacionAux = "IC";
    
    private $sessionPost;
    
    private $model;
    
    private $upload;
    
    private $oldName;
    
    public $vista = "_form";
    
    public $error;
    
    public $controler;
    
    public $schema = "Herramientas";
    
    public $proceso;
    
    
    
    public $result = array();
    
    
    
    public function __construct($controlador)
    {
        if(isset($_POST) && is_object($controlador))
        {
            $this->operacion = $_POST['action'];
            $this->sessionPost = $_POST;            
            $this->controler = $controlador;
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
                $this->cargarModeloHerraminetas();
                $this->upload = new ClassUploadFile($this->model, 'filename');
                $this->model->logo = $this->upload->filename;
                $this->insertarDatosHerramientas();
                $this->upload->saveFile();
            break;
            case 'U':                
                $this->cargarModeloHerraminetas();
                $this->oldName = $this->model->logo;
                $this->upload = new ClassUploadFile($this->model, 'filename');
                $this->model->logo = $this->upload->filename;
                $this->actualizarDatosHerraminetas();                
            break;
            case 'C':
                $this->schema = "HerramientasEntidad";
                $this->cargarModeloHerraminetasEntidad();
                $this->insertarDatosHerramientas();
            break;
            case 'IC':
                $this->schema = "HerramientasEntidad";
                $this->cargarModeloHerraminetasEntidad();
                $this->insertarDatosHerramientas();
            break;
            case 'UC':
                $this->schema = "HerramientasEntidad";
                $this->cargarModeloHerraminetas();
                $this->actualizarDatosHerraminetas();
            break;
            case 'LP':
                $this->schema = "Planes";
                $this->vista = "adminplanes";
                $this->cargarModelo();
                $this->model = $this->proceso->getModel();
                $this->prepararResultado(0);
            break;
            case 'IP':
                $this->schema = "Planes";
                $this->vista = "_formplanes";
                $this->cargarModelo();
                $this->model = $this->proceso->getModel();
                $this->prepararResultado( $this->proceso->insertar( $this->schema ) );
            break;
            case 'UP':
                $this->schema = "Planes";
                $this->vista = "_formplanes2";
                $this->cargarModelo();                  
                $this->model = $this->proceso->getModel();
                $this->prepararResultado( $this->proceso->insertar( $this->schema ) );
            break;
            case 'JSON':
                $this->cargarModeloHerraminetas();
                $this->vista = "_formaddjson";
                $this->prepararResultado( $this->insertarDatosJson() );
            break;
        }
        
        return $this;
    }
    
    
    private function insertarDatosHerramientas()
    {
        $result = 0;
        
        if(isset($this->sessionPost[$this->schema]))
        {
            $this->model->attributes = $this->sessionPost[$this->schema];
            $result = -1;
            
            if($this->model->save())
            {
                $result = 1;
            }
            
        }
        
        $this->prepararResultado($result);
    }
    
    
    private function insertarDatos()
    {
        $result = 0;
        
        if(isset($this->sessionPost[$this->schema]))
        {
            $this->model->attributes = $this->sessionPost[$this->schema];
            $result = -1;
            
            if($this->model->save())
            {
                $result = 1;
            }
            
        }
        
        $this->prepararResultado($result);
    }
    
    
    private function actualizarDatosHerraminetas()
    {
        $result = 0;
        
        if(isset($this->sessionPost[$this->schema]))
        {
            $this->model->attributes = $this->sessionPost[$this->schema];
            $result = -1;
            
            if($this->model->save())
            {
                $this->upload->saveFile(0,$this->oldName);
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
                $this->result['formulario'] = $this->controler->render('herramientas/'.$this->vista, array(
                                                'model'=>$this->model,
                                                'action'=>$this->operacion,
                                                'id'=>$this->sessionPost['id'],
                                                'aux'=>$this->operacionAux,
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
    
    
    private function cargarModeloHerraminetas()
    {        
        $this->model = new $this->schema;
        
        switch ($this->operacion)
        {
            case 'U':
            case 'D':
            case 'UC':
            case 'JSON':
                
                $this->vista = "_form";
                if(is_numeric($this->sessionPost['id']))
                {
                    $this->model = $this->model->findByPk($this->sessionPost['id']); 
                }
            break;
        }
    }
    
    
    private function insertarDatosJson()
    {
        $result = 0;        
        $aDatos = array();
        if(isset($this->sessionPost['config']))
        {
            $result = 1;
            $in = $this->sessionPost['config'];
            
            for($i=1; $i<6; $i++)
            {
                if( isset($in['codigo_'.$i]) && !empty($in['codigo_'.$i]) && isset($in['valor_'.$i]) )
                {
                    $aDatos[$in['codigo_'.$i]] = $in['valor_'.$i];
                }            
                
            }  
            
            $json['config'] = $aDatos;
            $this->model->json_config = json_encode($json);
            $this->saveData();
        }
        
        return $result;
    }
    
    
    
    private function saveData()
    {
        if($this->model->save())
        {
            return 1;
        }
        
        return -1;
    }
    
    
    private function cargarModeloHerraminetasEntidad()
    {
        
        switch ($this->operacion)
        {
            case 'C':
            case 'IC':
                $this->model = new HerramientasEntidad;                
                if(is_numeric($this->sessionPost['id']))
                {
                    $criteria=new CDbCriteria;
                    $this->vista = "_form2";
                    $criteria->condition = "idherramienta = 1 AND identidad = ".$this->sessionPost['id']; 
                    $row = $this->model->find($criteria);
                    
                    if(!is_null($row))
                    {
                        $this->operacionAux = "UC";
                        $this->model = $row;
                    }
                }
            break;
        }
    }
    
    
    
    private function cargarModelo()
    {
        $clase = $this->getClases();
        //include Yii::app()->request->baseUrl."/protected/models/modelosProcesos/".$this->getClases().".php";
        Yii::import('application.models.modelosProcesos.'.$clase);        
        $modelo = new $clase;        
        $this->proceso = $modelo->iniciarCarga($this->sessionPost);
    }
    
    
    private function getClases()
    {
        return $this->schema."Procesos";
    }
    
}