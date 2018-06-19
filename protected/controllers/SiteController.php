<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		//$this->render('index');
	    //Yii::app()->user->logout();
		if(!Yii::app()->user->isGuest)
		{
		    //$this->render('index');
		    $this->settingUsuario();
		}
		else
		{
		    $this->redirect(Yii::app()->createUrl('/site/login'));
		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    $this->layout = 'columnerror';
		if($error=Yii::app()->errorHandler->error)
		{
		    //var_dump($error);die;
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
	
	
	private function settingUsuario()
	{
	    
	    if(Yii::app()->user->isSuperAdmin)
	    {
	        Yii::app()->user->getField('nombreuser');
	        Yii::app()->user->getField('apellidouser');
	        Yii::app()->user->setState('usersistema', Yii::app()->user->getField('nombreuser'));
	        $this->redirect(Yii::app()->createUrl('/PanelAdministrativo/index'));
	        
	    }
	    
	    return false;
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
	    
	    if(Yii::app()->user->isGuest)
	    {
	        //$this->layout = CrugeUtil::config()->loginLayout;
	        $this->layout = 'columnlogin';
	        
	        $model = Yii::app()->user->um->getNewCrugeLogon('login');
	        
	        // por ahora solo un metodo de autenticacion por vez es usado, aunque sea un array en config/main
	        //
	        $model->authMode = CrugeFactory::get()->getConfiguredAuthMethodName();
	        
	        Yii::app()->user->setFlash('loginflash', null);
	        
	        Yii::log(__CLASS__ . "\nactionLogin\n", "info");
	        
	        if (isset($_POST[CrugeUtil::config()->postNameMappings['CrugeLogon']])) {
	            $model->attributes = $_POST[CrugeUtil::config()->postNameMappings['CrugeLogon']];
	            if ($model->validate()) {
	                if ($model->login(false) == true) {
	                    
	                    Yii::log(__CLASS__ . "\nCrugeLogon->login() returns true\n", "info");
	                    
	                    // a modo de conocimiento, Yii::app()->user->returnUrl es
	                    // establecida automaticamente por CAccessControlFilter cuando
	                    // preFilter llama a accessDenied quien a su vez llama a
	                    // CWebUser::loginRequired que es donde finalmente se llama a setReturnUrl
	                    $this->redirect(Yii::app()->user->returnUrl);
	                } else {
	                    Yii::app()->user->setFlash('loginflash', Yii::app()->user->getLastError());
	                }
	            } else {
	                Yii::log(
	                    __CLASS__ . "\nCrugeUser->validate es false\n" . CHtml::errorSummary($model)
	                    ,
	                    "error"
	                    );
	            }
	        }
	        $this->render('login', array('model' => $model));
	    }
	    else
	    {
	        $this->settingUsuario();
	    }
			
			
	}	

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		/*Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);*/
	    
	    // retorna false si ocurrio un error O si el filtro de sesion
	    // dispone de onBeforeLogin el cual ha retornado false.
	    if(Yii::app()->user->logout() == false){
	        // se devuelve a la URL de donde vino
	        $this->redirect(Yii::app()->user->returnUrl);
	        return;
	    }else{
	        
	       /* $herramientas = new PlanesEntidad;
	        $herramientas->clearVariableHerramientas();
	        Yii::app()->user->setState('entidad',null);
	        Yii::app()->user->setState('usersistema', null);
	        Yii::app()->user->setState('logoentidad', null);*/
	        $this->redirect(Yii::app()->user->ui->loginurl);
	    }
	    
	    
	}
}