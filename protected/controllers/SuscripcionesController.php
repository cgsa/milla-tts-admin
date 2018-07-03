<?php

class SuscripcionesController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout='//layouts/columnadminnew';
    
    
    public $tituloMail = "";
    
    
    public $asunto = "";
    
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
	    $this->titulopagina = "Vista Suscripción";
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionEnviarPromociones()
	{
	    
	    try 
	    {
	        if( $_POST && $_POST['action'] == 'DP' )
	        {
	            $this->layout = "dialogo";
	            $this->tituloMail = "Boletín de Promociones";
	            $this->asunto = "Boletín de Promociones Mensual";
	            $content = $this->renderPartial('_mail',array(
	                //'model'=>$this->loadModel($id),
	            ),true);
	            
	            $criteria=new CDbCriteria;
	            $criteria->condition = "status = 1";
	            $rows = Suscripciones::model()->findAll($criteria);
	            
	            foreach ($rows as $key =>$value)
	            {
	                $this->sendMessage($value->email, $content);
	            }
	            
	            $result['status'] = true;
	            
	        }
	        else
	        {
	            throw new Exception("Se ha producido un error inesperado");
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
	    $model=new Suscripciones;
	    $this->titulopagina = "Nueva Suscripción";

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Suscripciones']))
		{
			$model->attributes=$_POST['Suscripciones'];
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
	    $this->titulopagina = "Actualizar Suscripción";

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Suscripciones']))
		{
			$model->attributes=$_POST['Suscripciones'];
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
		$dataProvider=new CActiveDataProvider('Suscripciones');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
	    $model=new Suscripciones('search');
	    $this->titulopagina = "Suscripciones";
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Suscripciones']))
			$model->attributes=$_GET['Suscripciones'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Suscripciones the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Suscripciones::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	
	private function sendMessage( $email,$body)
	{
	    Yii::import('application.extensions.phpmailer.JPhpMailer');
	    
	    $mail = new JPhpMailer;
	    $mail->IsSMTP();
	    $mail->Host = 'ssl://smtp.gmail.com';
	    $mail->Port = 465;
	    $mail->SMTPAuth = true;
	    $mail->Username = 'edwin.zapata@contactogarantido.com';
	    $mail->Password = 'garantido414';
	    $mail->CharSet = 'utf-8';
	    $mail->SMTPDebug  = 0;
	    $mail->SetFrom('info@crediviajes.coppercu.com', $this->tituloMail);
	    $mail->Subject = $this->asunto;
	    $mail->AltBody = $this->asunto;
	    $mail->MsgHTML($body);
	    $mail->AddAddress($email, $this->tituloMail);
	    //$mail->AddBCC($email2,$config->titulo);
	    return $mail->Send();
	}
	

	/**
	 * Performs the AJAX validation.
	 * @param Suscripciones $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='suscripciones-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
