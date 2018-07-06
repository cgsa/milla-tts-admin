<?php

class PromocionUsuarioController extends Controller
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
		$model=new PromocionUsuario;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PromocionUsuario']))
		{
			$model->attributes=$_POST['PromocionUsuario'];
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
	public function actionDetalle($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['PromocionUsuario']))
		{
			$model->attributes=$_POST['PromocionUsuario'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('_detalle',array(
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
	                case 'C':
	                    $model = new PagosPromociones;
	                    $result['status'] = true;
	                    $result['formulario'] = $this->renderPartial('_cupones', array(
	                        'model'=>$model,
	                        'action'=>'C',
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
	        $result = array();
	        if( isset($_POST))
	        {
	            switch ($_POST['action'])
	            {
	                case 'C':
	                    
	                    if( isset($_POST['PagosPromociones']) )
	                    {
	                        $model = PagosPromociones::model()->findByPk($_POST['id']);
	                        $model->attributes = $_POST['PagosPromociones'];
	                        
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
	 * Manages all models.
	 */
	public function actionAdmin()
	{
	    $this->titulopagina = "Promociones Usuarios";
		$model=new PromocionUsuario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['PromocionUsuario']))
			$model->attributes=$_GET['PromocionUsuario'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return PromocionUsuario the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=PromocionUsuario::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param PromocionUsuario $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='promocion-usuario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
