<?php

class GestionHerramientasController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/columnadminnew';
    
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            array('CrugeAccessControlFilter')
        );
    }
    
    
    
    
    /**
     * Muestra el listado de herramientas.
     */
    public function actionIndex()
    {
        $this->titulopagina = "Herramientas";
        $model = new Herramientas;
        $this->render('herramientas/admin',array(
            'model'=>$model,
        ));
    }
    
    /**
     * Muestra el listado de planes por herramientas.
     */
    public function actionActivacion($id)
    {
        $model = new Planes;
        $planesEntidad = new PlanesEntidad;
        $this->titulopagina = "Planes";
        $this->render('herramientas/planes',array(
            'model'=>$model,
            'model2'=>$planesEntidad,
            'id'=>$id
        ));
    }
    
    /**
     * Muestra el listado de planes por herramientas.
     */
    public function actionConfiguracion()
    {
        $model = new Planes;
        $planesEntidad = new PlanesEntidad;
        $this->titulopagina = "Configuración";
        $this->render('herramientas/planesactivos',array(
            'model'=>$model,
            'model2'=>$planesEntidad
        ));
    }
    
    
    
    /**
     * Muestra los mensajes.
     */
    public function actionOperacionPlanes()
    {
        $result = array();
        try
        {
            //var_dump($_POST);die;
            $vista = "";
            $this->layout = "dialogo";
            $operaciones = new OperacionesPlanes($this);
            $result = $operaciones->init()->result;
            
            
        }
        catch (Exception $e)
        {
            $result['status'] = false;
            $result['mensaje'] = $e->getMessage();
        }
        
        header('Content-type: application/json');
        die(json_encode($result));
    }   
    
    
    
    
}