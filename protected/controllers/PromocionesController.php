<?php

class PromocionesController extends Controller
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
	    $model=new Promociones;
	    $model2 = new Imagenes;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Promociones']))
		{
		    // Set the uplaod directory
		    $uploadDir = Yii::app()->basePath .'/../upload/img';
			$model->attributes=$_POST['Promociones'];
			
			$imageUploadFile = CUploadedFile::getInstance($model2, 'Filedata');
			//var_dump($imageUploadFile);die;
			if(!empty($imageUploadFile))
			{
			    
			    $file = rand(0,999999)."-{$imageUploadFile}";
			    $imageUploadFile->saveAs($uploadDir.'/'.$file);
			    
			    $model2->path = $file;
			    $model2->save();
			    $model->id_imagen = $model2->id;
			    
			    if($model->save())
			    {
			        $this->redirect(array('view','id'=>$model->id));
			    }
			    
			}
			else
			{
			    throw new CHttpException(404,'Hubo un error con la imagen.');
			}
			
			
		}

		$this->render('create',array(
			'model'=>$model,
		));
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

		if(isset($_POST['Promociones']))
		{
			$model->attributes=$_POST['Promociones'];
			// Set the uplaod directory
			$uploadDir = Yii::app()->basePath .'/../upload/img';
			$model2 = new Imagenes;
			
			//var_dump($_FILES['Imagenes']);die;
			//$thumb = $model->createImageThumb( $_FILES['Imagenes']['name']['Filedata'], "120" );
			$imageUploadFile = CUploadedFile::getInstance($model2, 'Filedata');
			//var_dump($imageUploadFile);die;
			if(!empty($imageUploadFile))
			{
			    $file = rand(0,999999)."-{$imageUploadFile}";
			    $imageUploadFile->saveAs($uploadDir.'/'.$file);
			    
			    $model2->path = $file;
			    $model2->save();
			    $model->id_imagen = $model2->id;
			    
			}
			
			if($model->save())
			{
			    $this->redirect(array('view','id'=>$model->id));
			}
			
			
		}

		$this->render('update',array(
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
	                $destino->id_destino = $id;
	                $destino->id_imagen = $model->id;
	                $destino->save();
	                echo 1;
	                
	            }
	            
	        }
	        
	    }
	    
	    
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
		$dataProvider=new CActiveDataProvider('Promociones');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Promociones('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Promociones']))
			$model->attributes=$_GET['Promociones'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Promociones the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Promociones::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Promociones $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='promociones-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
