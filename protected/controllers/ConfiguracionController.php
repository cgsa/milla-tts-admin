<?php

class ConfiguracionController extends Controller
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
	    
	    $this->titulopagina = "Configuración";
	    $model = $this->loadModel(1);
	    if( is_null($model))
	    {
	        $model= new Configuracion;
	    }
	    
		if(isset($_POST['Configuracion']))
		{
		    $model->attributes=$_POST['Configuracion'];
		    $model->id = 1;
		    $model->save();
		}
			

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Configuracion the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Configuracion::model()->findByPk($id);
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Configuracion $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='configuracion-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
