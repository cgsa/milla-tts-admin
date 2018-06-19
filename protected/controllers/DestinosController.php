<?php

class DestinosController extends Controller
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Destinos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Destinos']))
		{
			$model->attributes=$_POST['Destinos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionImagenes($id)
	{
	    $model = new GaleriaDestino();
	    $this->render('imagenes',array(
	        'model'=>$model,
	        'id'=>$id,
	    ));
	}
	
	
	public function actionUpload($id)
	{
	    //die($id);
	    if( isset($_POST['timestamp']) )
	    {
	        // Set the uplaod directory
	        $uploadDir = Yii::app()->basePath .'/../upload/img';	        
	        $verifyToken = md5('unique_salt' . $_POST['timestamp']);
	        $model = new Imagenes;	        
	        $imageUploadFile = CUploadedFile::getInstance($model, 'Filedata');
	        if(!empty($imageUploadFile))
	        {
	            $file = rand(0,999999)."-{$imageUploadFile}";
	            $imageUploadFile->saveAs($uploadDir.'/'.$file);	            
	            $model->path = $file;	            
	            
	            if($model->save())
	            {      
	                $destino = new GaleriaDestino;
	                $destino->id_destino = (int)$id;
	                $destino->id_imagen = $model->id;
	                $destino->save();
	                echo 1;	                
	                
	            }
	            
	        }
	        
	   }
	    
	        
	}
	
	
	/**
	 * View dialogo.
	 */
	public function actionFormulario()
	{
	    try
	    {
	        if(isset($_POST))
	        {
	            switch ($_POST['action'])
	            {
	                case 'B':
	                    $model = new Banner;
	                    $result['status'] = true;
	                    $result['formulario'] = $this->renderPartial('_banner', array(
	                        'model'=>$model,
	                        'action'=>'B',
	                        'id'=>$_POST['id'],
	                        'destino'=>$_POST['destino'],
	                    ),true);
	               break;
	            }
	        }
	        else
	        {
	            throw new Exception('Se ha producido una error al intentar realizar la acción.');
	        }
	        
	    }
	    catch (Exception $e)
	    {
	        $result['status'] = true;
	        $result['mensaje'] = $e->getMessage();
	    }
	    
	    die(json_encode($result));
	}
    
    /**
     * View dialogo.
     */
    public function actionRegistrar()
    {
        try
        {
            $result = array();
            
            if( isset($_POST))
            {
                switch ($_POST['action'])
                {
                    case 'P':
                        
                        if( isset($_POST['id']) )
                        {
                            $connection=Yii::app()->db;
                            $sql="UPDATE galeria_destino SET es_principal = 0 WHERE id_destino =:destino ";
                            $command=$connection->createCommand($sql);
                            $command->bindParam(":destino",$_POST['destino'],PDO::PARAM_INT);
                            $command->execute();
                            
                            $model = GaleriaDestino::model()->findByPk($_POST['id']);
                            $model->es_principal = 1;
                            $model->save();
                            
                            $result['status'] = true;
                            $result['mensaje'] = 'El registro se realizó de manera satisfactoria.';
                        }
                        else
                        {
                            throw new Exception('Se ha producido una error al intentar realizar la acción.');
                        }
                    break;
                    case 'B':
                        
                        if( isset($_POST['Banner']) )
                        {   
                            $model = new Banner;
                            $model->attributes = $_POST['Banner'];
                            $json['controlador'] = "Destinos";
                            $json['value'] = $_POST['id'];
                            $model->data_json = json_encode($json);
                            
                            if($model->save())
                            {
                                $result['status'] = true;
                                $result['mensaje'] = 'El registro se realizó de manera satisfactoria.';
                            }
                            
                        }
                        else
                        {
                            throw new Exception('Se ha producido una error al intentar realizar la acción.');
                        }
                    break;
                }
            }
            else
            {
                throw new Exception('Se ha producido una error al intentar realizar la acción.');
            }
            
        }
        catch (Exception $e)
        {
            $result['status'] = true;
            $result['mensaje'] = $e->getMessage();
        }
        
        die(json_encode($result));
    }

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Destinos']))
		{
			$model->attributes=$_POST['Destinos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Destinos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Destinos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Destinos']))
			$model->attributes=$_GET['Destinos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Destinos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Destinos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Destinos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='destinos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
