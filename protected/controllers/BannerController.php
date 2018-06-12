<?php

class BannerController extends Controller
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
		$model=new Banner;
		$model2 = new Imagenes;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Banner']))
		{
		    // Set the uplaod directory
		    $uploadDir = Yii::app()->basePath .'/../upload/img';
		    $model->attributes=$_POST['Banner'];
		    $criteria=new CDbCriteria;
		    $criteria->condition = "controlador = '".$model->controlador."'";
		    $criteria->condition .= " AND id_contralador = ".$model->id_contralador;
		    $rows = $model->find($criteria);
		    //var_dump($rows);die;
		    if( is_null($rows) )
		    {
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
		    else
		    {
		        Yii::app()->user->setFlash('error', "Ya esta registrado un banner con este enlace");
		    }
		    		    
			
			
		}

		$this->render('create',array(
			'model'=>$model,
		));
		
	}
	
	
	private function eliminarArchivo( $file )
	{
	    if( file_exists($file) )
	    {
	        unlink($file);
	    }
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

		if(isset($_POST['Banner']))
		{
			$model->attributes=$_POST['Banner'];
			// Set the uplaod directory
			$uploadDir = Yii::app()->basePath .'/../upload/img';
			$model2 = new Imagenes;
			$criteria=new CDbCriteria;
			$criteria->condition = "controlador = '".$model->controlador."'";
			$criteria->condition .= " AND id_contralador = ".$model->id_contralador;
			$criteria->condition .= " AND id <> ".$id;
			$rows = $model->find($criteria);
			
			if( is_null($rows) )
			{
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
			else
			{
			    Yii::app()->user->setFlash('error', "Ya esta registrado un banner con este enlace");
			}
			
			
		}

		$this->render('update',array(
			'model'=>$model,
		));
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
	        $result = "";
	        if( isset($_POST))
	        {
	            switch ($_POST['action'])
	            {
	                case 'P':
	                    
	                    if( isset($_POST['id']) )
	                    {
	                        $connection=Yii::app()->db;
	                        $sql="UPDATE galeria_promocion SET es_principal = 0 WHERE id_destino =:destino ";
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
	                        $json['contralador'] = "Destinos";
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
	
	
	
	public function actionCombos()
	{
	   
	    try 
	    {
	        if( isset($_POST['action']) )
	        {
	            switch ($_POST['action']) 
	            {
	                case 'destinos':
	                    $model = new Destinos;
	                    $criteria=new CDbCriteria;
	                    $criteria->condition = "status = 1";
	                    $rows = $model->findAll($criteria); 
	                    $atributo = "nombre";
	                    
	                break;	                
	                case 'promociones':
	                    $model = new Promociones;
	                    $criteria=new CDbCriteria;
	                    $criteria->condition = "status = 1";
	                    $rows = $model->findAll($criteria);
	                    $atributo = "titulo";
	                break;
	            }	            
	            
	            $select = "<option value='' >--Seleccione--</option>";
	            foreach ($rows as $key => $value) {
	                $select .= "<option value='".$value->id."' >".$value->$atributo."</option>";
	            }	 
	            
	            $result['status'] = true;
	            $result['combo'] = $select;
	            
	        }
	        else
	        {
	            throw new Exception('Se ha presentado un error inesperado.');
	        }
	        
	    } 
	    catch (Exception $e) 
	    {
	        $result['status'] = false;
	        $result['mensaje'] = $e->getMessage();
	    }
	    
	    
	    die(json_encode($result));
	    
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
		$dataProvider=new CActiveDataProvider('Banner');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Banner('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Banner']))
			$model->attributes=$_GET['Banner'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Banner the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Banner::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Banner $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='banner-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
