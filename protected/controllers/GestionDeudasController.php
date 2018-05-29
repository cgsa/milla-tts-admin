<?php

class GestionDeudasController extends Controller
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
     * Muestra el listado de importación mas reciente.
     */
    public function actionImportar($id = null )
    {
        $this->titulopagina = "Deudas Activas";
        $model = new UsrDeudasLotesRepository;
        
        if( $id != null )
        {            
            $datos = $model->getDeudaDetalle( $id );
            $model2 = new OpcionesPagoRepository;
            $datos2 = $model2->getListOpcionesPago($datos->identificacion_unica_cliente);
            $criteria=new CDbCriteria;
            $criteria->condition = " identidad = ".$datos->identidad;
            $result = EtiquetasCamposAdicionales::model()->find($criteria);
            $etiqueta = is_null($result)? "" : $result;
            
            
            $this->render('deudas/detalledeuda',array(
                'model'=>$datos,
                'etiqueta'=>$etiqueta,
                'cuotas'=>$datos2
            ));
            
            Yii::app()->end();
        }
        
        $this->render('deudas/admin',array(
            'model'=>$model->getDeudasActivas(),
        ));
    }
    
    
    
    public function actionCargarDeudas()
    {
        
        if (isset($_POST['UsrDeudas']))
        {
            Yii::import('application.components.ClassImportadoraCSV');
            $model = new UsrDeudasLotesRepository;
            $imageUploadFile = CUploadedFile::getInstance($model->modelo, 'filename');
            $import = new ClassImportadoraCSV($imageUploadFile);
            $model->registrarDeudas($import);
            Yii::app()->user->setFlash('success', $import->procesados);
            $this->redirect(array('GestionDeudas/importar'));
            
        }
        else if (isset($_POST['OpcionesPago']))
        {
            
            Yii::import('application.components.ClassImportadoraCSV');
            $model = new OpcionesPagoRepository;
            $imageUploadFile = CUploadedFile::getInstance($model->modelo, 'filename');
            $import = new ClassImportadoraCSV($imageUploadFile);
            $model->registrarOpciones($import);
            Yii::app()->user->setFlash('success', $import->procesados);
            $this->redirect(array('GestionDeudas/importar'));
            
        }
        
        
    }
    
    
    
    public function actionCargarOpcionesPago()
    {
        
        if (isset($_POST['OpcionesPago']))
        {
            Yii::import('application.components.ClassImportadoraCSV');
            $model = new OpcionesPagoRepository();
            $imageUploadFile = CUploadedFile::getInstance($model->modelo, 'filename');
            $import = new ClassImportadoraCSV($imageUploadFile);
            $model->registrarDeudas($import);
            Yii::app()->user->setFlash('success', $import->procesados);
            $this->redirect(array('GestionDeudas/importar'));
            
        }
        
        
    }
    
    
    /**
     * Muestra el listado de Deudas API.
     */
    public function actionDeudasApi($id = null )
    {
        $this->titulopagina = "Deudas Activas";
        $model = new UsrDeudasLotesRepository;
        
        if( $id != null )
        {
            $datos = $model->getDeudaDetalle( $id );
            $criteria=new CDbCriteria;
            $criteria->condition = " identidad = ".$datos->identidad;
            $result = EtiquetasCamposAdicionales::model()->find($criteria);
            $etiqueta = is_null($result)? "" : $result;
            
            
            $this->render('deudas/detalledeuda',array(
                'model'=>$datos,
                'etiqueta'=>$etiqueta
            ));
            
            Yii::app()->end();
        }
        
        $this->render('deudas/admin',array(
            'model'=>$model->getDeudasActivas(),
        ));
    }
    
    
    
    /**
     * Formulario para configurar las etiquetas de los campos adicionales.
     */
    public function actionEtiquetas()
    {
        $this->titulopagina = "Etiquetas Campos Adicionales";
        $model = new EtiquetasCamposAdicionales;
        
        if(isset($_POST['EtiquetasCamposAdicionales']))
        {
            $model = $model->findByPk($_POST['EtiquetasCamposAdicionales']['id']);
            $model->attributes = $_POST['EtiquetasCamposAdicionales'];
            $result = -1;
            
            if($model->save())
            {
                $result = 1;
            }
            
        }
        
        $this->render('deudas/etiquetas',array(
            'model'=>$model->getEtiquetas(),
        ));
    }
    
    
    
    public function actionDialogoImportador()
    {
        
        
        try
        {
            
            if($_POST)
            {
                
                switch ($_POST['action']) 
                {
                    case 'D':
                        $model = new UsrDeudas;
                    break;                    
                    case 'O':
                        $model = new OpcionesPago;
                    break;
                }
                
                $content = $this->renderPartial('deudas/dialogoimportardor',array(
                    'model'=>$model,
                ), true);
                
                header('Content-type: application/json');
                $result['status'] = true;
                $result['content'] = $content;
                die(json_encode($result));
            }
            else
            {
                throw new Exception('La vista que intenta acceder no existe.');
            }
            
            
        }
        catch (Exception $e)
        {
            header('Content-type: application/json');
            $result['status'] = false;
            $result['mensaje'] = $e->getMessage();
            die(json_encode($result));
        }
    }
    
    
    /**
     * Muestra los mensajes.
     */
    public function actionPreguntas()
    {
        $model = new MensajesInterno;
        $this->titulopagina = "Preguntas";
        $this->render('mensajes/admin',array(
            'model'=>$model,
        ));
    }
    
    
    
    public function actionOperacionMensajes()
    {
        //header('Content-type: application/json');
        $result = array();
        try
        {
            $vista = "";
            $this->layout = "dialogo";
            $operaciones = new OperacionesMensajes($this);
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