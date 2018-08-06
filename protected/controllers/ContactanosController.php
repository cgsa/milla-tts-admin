<?php

class ContactanosController extends Controller
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
	    $this->titulopagina = "Vista de Mensaje de Contacto";
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
	    $this->titulopagina = "Mensajes de Contacto";
		$model=new Contactanos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Contactanos']))
			$model->attributes=$_GET['Contactanos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Contactanos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Contactanos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Contactanos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='contactanos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
