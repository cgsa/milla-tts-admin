<?php
class OperacionesPlanes
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
            
            case 'CP':
                $this->schema = "PlanesEntidad";
                $this->vista = "_form";
                $this->cargarModelo();                
                $this->proceso->loadData();                
                $this->model = $this->proceso->getModel();
                $this->model->data = $this->proceso->findDataJson(); 
                $this->prepararResultado(0);
            break;
            case 'AP':
                $this->schema = "PlanesEntidad";
                $this->cargarModelo();
                $this->model = $this->proceso->getModel();
                $this->prepararResultado( $this->proceso->activar() );
                break;
            case 'UP':
                $this->schema = "PlanesEntidad";
                $this->cargarModelo();
                $this->prepararResultado( $this->proceso->update() );
            break;
            case 'LP'://_formplanesactivo
                $this->schema = "PlanesEntidad";
                $this->vista = "_listplanesactivos";
                $this->cargarModelo();
                $this->proceso->loadData("all");
                $this->model = $this->proceso->getModel();
                $this->prepararResultado( 0 );
            break;
            case 'IAP':
                $this->schema = "PlanesEntidad";
                $this->vista = "_formplanesactivo";
                $this->cargarModelo();
                $this->model = $this->proceso->getModel();   
                //die("aquiiii ".$this->proceso->insertForSystemAdmin());
                $this->prepararResultado( $this->proceso->saveForSystemAdmin() );
                break;
            case 'UPP':
            $this->schema = "PlanesEntidad";
            $this->vista = "_formplanesactivo2";
            $this->cargarModelo();
            $this->proceso->loadData(); 
            $this->model = $this->proceso->getModel();
            //die("aquiiii ".$this->proceso->insertForSystemAdmin());
            $this->prepararResultado( $this->proceso->saveForSystemAdmin() );
            break;
            case 'PP':                
            $this->schema = "PlanesEntidad";
            $this->cargarModelo();
            $this->result['combo'] = $this->proceso->findDataCombo();   
            $this->result['cjson'] = $this->proceso->findDataJson();  
            $this->prepararResultado( 2 );
            break;
        }
        
        return $this;
    }
    
    
    private function prepararResultado($r)
    {
        $this->result['status'] = true;
        
        switch ($r) {
            case 2:
                //$this->result['status'] = true;
            break;
            case 1:
                $this->result['mensaje'] = "El registro se realizó de manera satisfactoria.";
            break;
            case 0:
                $this->result['formulario'] = $this->controler->render('planes/'.$this->vista, array(
                'model'=>$this->model,
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