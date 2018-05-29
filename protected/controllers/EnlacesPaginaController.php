<?php

class EnlacesPaginaController extends Controller
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
	 * View dialogo.
	 */
	public function actionDialogo()
	{
	    try 
	    {
	        if(isset($_POST))
	        {
	            switch ($_POST['action']) 
	            {
	                case 'I':
	                   $model = new EnlacesPagina;
	                   $result['status'] = true;
	                   $result['formulario'] = $this->renderPartial('_form', array(
	                       'model'=>$model,
	                       'action'=>'I',
	                       'id'=>$_POST['id']
	                   ),true);
	                   
	                break;	                
	                case 'U':
	                    $model = $this->loadModel($_POST['id']);;
	                    $result['status'] = true;
	                    $result['formulario'] = $this->renderPartial('_form', array(
	                        'model'=>$model,
	                        'action'=>'U',
	                        'id'=>$_POST['id']
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
	        if(isset($_POST) && isset($_POST['EnlacesPagina']))
	        {
	            switch ($_POST['action'])
	            {
	                case 'I':
	                    $model = new EnlacesPagina;
	                    $model->attributes=$_POST['EnlacesPagina'];
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
	                case 'U':
	                    $model = $this->loadModel($_POST['id']);;
	                    $model->attributes=$_POST['EnlacesPagina'];
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new EnlacesPagina;

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return EnlacesPagina the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=EnlacesPagina::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param EnlacesPagina $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='enlaces-pagina-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
