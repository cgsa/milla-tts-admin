<?php

class ImagenesController extends Controller
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
		$model=new Imagenes;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Imagenes']))
		{
			$model->attributes=$_POST['Imagenes'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['Imagenes']))
		{
			$model->attributes=$_POST['Imagenes'];
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
		$dataProvider=new CActiveDataProvider('Imagenes');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	
	/**
	 * View dialogo.
	 */
	public function actionRegistrar()
	{
	    try
	    {
	        if( isset($_POST) )
	        {
	            switch ($_POST['action'])
	            {
	                case 'U':
                        $model = $this->loadModel($_POST['id']);
                        $model->attributes=$_POST['Imagenes'];
                        if($model->save())
                        {
                            $result['status'] = true;
                            $result['mensaje'] = 'El registro se realizó de manera satisfactoria.';
                        }
                        else
                        {
                            throw new Exception('Se ha producido una error al intentar realizar la acción.');
                        }
                    break;
	                case 'E':
	                    $model = $this->loadModel($_POST['id']);
	                    //var_dump($model);die;
	                    $file = Yii::app()->basePath .'/../upload/img/'.$model->path;
	                    if( $model->delete() )
	                    {
	                        if( file_exists($file) )
	                        {
	                            unlink($file);
	                        }
	                        
	                        $result['status'] = true;
	                        $result['mensaje'] = 'La imagen se elimino de manera satisfactoria.';
	                    }
	                    else
	                    {
	                        throw new Exception('Se ha producido una error al intentar realizar la acción.');
	                    }
	                    
	                break;
	                case 'G':
	                    $model = new Galerias;
	                    $model->attributes=$_POST['Galerias'];
	                    if($model->save())
	                    {
	                        if( isset($_POST['imagenes']))
	                        {
	                            $connection=Yii::app()->db;
	                            $sql="INSERT INTO imagenes_galerias (id_galeria, id_imagen) VALUES(".$model->id.",:imagen)";
	                            $command=$connection->createCommand($sql);
	                            
	                            foreach ($_POST['imagenes'] as $value)
	                            {	                                
	                                $command->bindParam(":imagen",$value,PDO::PARAM_INT);
	                                $command->execute();
	                            }
	                        }
	                        
	                        $result['status'] = true;
	                        $result['mensaje'] = 'El registro se realizó de manera satisfactoria.';
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
	        $result['status'] = false;
	        $result['mensaje'] = $e->getMessage();
	    }
	    
	    header('Content-Type: application/json');
	    die(json_encode($result));
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
	                case 'N':
	                    $model = $this->loadModel($_POST['id']);;
	                    $result['status'] = true;
	                    $result['formulario'] = $this->renderPartial('_form', array(
	                        'model'=>$model,
	                        'action'=>'U',
	                        'id'=>$_POST['id']
	                    ),true);
	               break;
	               case 'G':
	                    $model = new Galerias;
	                    $imagen = new Imagenes;
	                    $result['status'] = true;
	                    $result['formulario'] = $this->renderPartial('_galeria', array(
	                        'model'=>$model,
	                        'imagen'=>$imagen,
	                        'action'=>'G',
	                        'ids'=>$_POST['ids']
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
	
	
	public function actionUpload()
	{
	    
	    // Set the uplaod directory
	    $uploadDir = Yii::app()->basePath .'/../upload/img';
	    
	    // Set the allowed file extensions
	    $fileTypes = array('jpg', 'jpeg', 'gif', 'png'); // Allowed file extensions
	    
	    $verifyToken = md5('unique_salt' . $_POST['timestamp']);
	    $model = new Imagenes;
	    
	    //var_dump($_FILES['Imagenes']);die;
	    //$thumb = $model->createImageThumb( $_FILES['Imagenes']['name']['Filedata'], "120" );
	    $imageUploadFile = CUploadedFile::getInstance($model, 'Filedata');
	    //var_dump($imageUploadFile);die;
	    if(!empty($imageUploadFile))
	    {
	        $file = rand(0,999999)."-{$imageUploadFile}";
	        $imageUploadFile->saveAs($uploadDir.'/'.$file);
	        
	        $model->path = $file;
	        
	        if($model->save())
	        {
	            echo 1;
	        }
	        //$thumb = $model->createImageThumb( $file, "120" );
	        
	        //$imageUploadFile->saveAs($uploadDir.'/'.$thumb);
	        
	    } 
	    
	}
	
	
	
	public function actionCheckFile()
	{
	    // Define a destination
	    $targetFolder = '/upload/img'; // Relative to the root and should match the upload folder in the uploader script
	    
	    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $targetFolder . '/' . $_POST['filename'])) {
	        echo 1;
	    } else {
	        echo 0;
	    }
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Imagenes;
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Imagenes']))
			$model->attributes=$_GET['Imagenes'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Imagenes the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Imagenes::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Imagenes $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='imagenes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
