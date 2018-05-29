<?php

class PanelAdministrativoController extends Controller
{
	/**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/columnadmin';
    
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            array('CrugeAccessControlFilter')            
        );
    }
    
    
    public function actionIndex()
    {
        /*if(Yii::app()->user->isSuperAdmin)
        {
            $this->redirect(array('Agentes'));
        }
        else if(Yii::app()->user->checkAccess('USER-AGENTE'))
        {
            //$this->redirect(array('Mensajes'));
            $this->layout = 'columnadminnew';
            $this->titulopagina = "Inicio";
            $this->render('index');
        }  */
        
        $this->layout = 'columnadminnew';
        $this->titulopagina = "Inicio";
        $this->render('index');
        
    }
    
    
    /**
     * Muestra el listado de importación mas reciente.
     
    public function actionImportar()
    {
        $this->titulopagina = "Deudas Activas";
        $this->layout = 'columnadminnew';
        $model = new UsrDeudasLotesRepository;
        $this->render('usrDeudasLotes/admin',array(
            'model'=>$model->getDeudasActivas(),
        ));
    }
    
    
    public function actionClasificacionDeudores()
    { 
        
        $model = new ClasificacionDeudores;
        $this->titulopagina = "Clasificación Deudores";
        $this->layout = "columnadminnew";
        $this->render('clasificacion/admin',array(
            'model'=>$model,
        ));
    }
    
    
    
    public function actionOperacionClasificacion()
    {
        $result = array();
        try
        {
            
            $vista = "";
            $this->layout = "dialogo";
            $operaciones = new OperacionesClasificacion($this);
            $result = $operaciones->init()->result;
            
            
        }
        catch (Exception $e)
        {
            $result['status'] = false;
            $result['mensaje'] = $e->getMessage();
        }
        
        header('Content-type: application/json');
        die(json_encode($result));
    }*/
    
    
    /**
     * Muestra las herramientas.
     */
    public function actionHerramientas()
    {
        $model = new Herramientas;
        $this->titulopagina = "Herramientas";
        $this->layout = "columnadminnew";
        $this->render('herramientas/admin',array(
            'model'=>$model,
        ));
    }
    
    /*
    public function actionHerramientasDisponibles()
    {
        $model = new Herramientas;
        $this->titulopagina = "Herramientas";
        $this->render('herramientas/admin2',array(
            'model'=>$model,
        ));
    }*/
    
    /*
    public function actionPlanes($id)
    {
        $model = new Planes;
        $planesEntidad = new PlanesEntidad;
        $this->titulopagina = "Planes";
        $this->render('planes/admin',array(
            'model'=>$model,
            'model2'=>$planesEntidad,
            'id'=>$id
        ));
    }*/
    
    
    /**
     * Muestra los mensajes.
     
    public function actionOperacionHerramientas()
    {
        $result = array();
        try
        {
            //var_dump($_POST);die;
            $vista = "";
            $this->layout = "dialogo";
            $operaciones = new OperacionesHerramientas($this);
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
    
    
    public function actionAgentes()
    {
        $this->titulopagina = "Agentes";
        $this->layout = "columnadminnew";
        $model = new UsrUsuariosAgentes;
        $this->render('usrUsuariosAgentes/admin',array(
            'model'=>$model,
        ));
    }
    
    
    public function actionOperacionesClave()
    {
        try
        {
            switch ($_POST['action'])
            {
                case 'C':
                    
                    $operaciones = new OperacionesClave;
                    if($operaciones->nuevaClave($_POST))
                    {
                        $result['status']   = true;
                        $result['mensaje']  = 'La operación se realizó de manera satisfactoria.';
                    }
                    else
                    {
                        $errores = CHtml::errorSummary($operaciones->model);
                        throw new Exception($errores);
                    }
                    
                    break;
            }
            
        }
        catch (Exception $e)
        {
            $result['status'] = false;
            $result['mensaje'] = $e->getMessage();
        }
        
        header('Content-type: application/json');
        die(json_encode($result));
    }
    
    
    public function actionAcreedores()
    {
        $this->titulopagina = "Acreedores";
        $this->layout = "columnadminnew";
        $model = new UsrEntidades;
        $this->render('usrEntidades/admin',array(
            'model'=>$model,
        ));
    }
    
    
    public function actionOperacionEntidades()
    {
        //header('Content-type: application/json');  
        try 
        {
            
            $vista = "";
            $model = new UsrEntidades;
            $id = "";
            if(isset($_POST))
            {
                Yii::import('application.components.ClassUploadFile');
                switch ($_POST['action']) 
                {
                    case 'I':
                        $vista = 'usrEntidades/_form';
                        if(isset($_POST['UsrEntidades']))
                        {
                            $model->attributes=$_POST['UsrEntidades'];
                            $up = new ClassUploadFile($model, 'filename');
                            $model->logo = $up->filename;
                            $model->fecha_carga = date('Y-m-d');
                            
                            if($model->save())
                            {
                                $etiqueta = new EtiquetasCamposAdicionales;
                                $etiqueta->identidad = (int)$model->id;
                                $etiqueta->save();  
                                
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
                    case 'C':
                    case 'IC':
                    case 'UC':
                        //var_dump($_POST);die;
                        $vista = "";
                        $this->layout = "dialogo";
                        $operaciones = new OperacionesHerramientas($this);
                        $result = $operaciones->init()->result;
                        die(json_encode($result)); 
                        break;
                    case 'LP':
                    case 'PP':
                    case 'UPP':
                    case 'IAP':
                        //var_dump($_POST);die;
                        $vista = "";
                        $this->layout = "dialogo";
                        $operaciones = new OperacionesPlanes($this);
                        $result = $operaciones->init()->result;
                        die(json_encode($result));
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
            }            
            
        } 
        catch (Exception $e) 
        {
            $result['status'] = false;
            $result['mensaje'] = $e->getMessage();
        }
        
        header('Content-type: application/json');  
        die(json_encode($result));
    }
    
    
    
    public function actionOperacionAgentes()
    {
        //header('Content-type: application/json');
        $result = array();
        try
        {
            
            $vista = "";
            $this->layout = "dialogo";
            $operaciones = new OperacionesAgentes($this);
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
    
    
    
    public function actionOperacionDeudas()
    {
        //header('Content-type: application/json');
        $result = array();
        try
        {
            $vista = "";
            $this->layout = "dialogo";
            $operaciones = new OperacionesDeudas($this);
            $result = $operaciones->init()->result;
            
            
        }
        catch (Exception $e)
        {
            $result['status'] = false;
            $result['mensaje'] = $e->getMessage();
        }
        
        header('Content-type: application/json');
        die(json_encode($result));
    }*/
    
    /**
     * Muestra el formulario para cambiar la clave del usuario conectado.
     
    public function actionCambioDeClave()
    {
        $this->titulopagina = "Cambio de clave";
        $this->layout = "columnadminnew";
        $operaciones = new OperacionesClave;
        $model = $operaciones->getModel();
        $this->render('perfil/_form',array(
            'model'=>$model,
        ));
    }*/
    
}