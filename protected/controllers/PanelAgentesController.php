<?php
class PanelAgentesController extends Controller
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
    
    
    public function actionIndex()
    {
        if(Yii::app()->user->checkAccess('USER-AGENTE'))
        {
            $this->layout = 'columnadminnew';
            $this->titulopagina = "Inicio";
            $this->render('index');
        }
        
    }    
    
    /**
     * Muestra el formulario para cambiar la clave del usuario conectado.
     */
    public function actionCambioDeClave()
    {
        $this->titulopagina = "Cambio de clave";
        $operaciones = new OperacionesClave;
        $model = $operaciones->getModel();
        $this->render('perfil/_form',array(
            'model'=>$model,
        ));
    }
    
    /**
     * Muestra el perfil del usuario conectado.
     */
    public function actionPerfil()
    {
        $this->layout = "columnadminnew";
        $model = new UsrUsuariosAgentes;
        $usuario = $model->getModelUsuarioCruge();
        $agente = $model->getModeloUsuarioAgente();
        
        if(isset($_POST['UsrUsuariosAgentes']))
        {
            $agente->attributes = $_POST['UsrUsuariosAgentes'];
            if(!$agente->save())
            {
                $errores = CHtml::errorSummary($agente);
                throw new CHttpException(500,$errores);
                Yii::app()->end;
            }
        }
        
        $this->titulopagina = "Perfil";
        $this->render('perfil/_formperfil',array(
            'usuario'=>$usuario,
            'agente'=>$agente
        ));
    }
    
    
    public function actionOperacionesPerfil()
    {
        try
        {
            switch ($_POST['action'])
            {
                case 'C':
                    
                    $operaciones = new OperacionesClave;                    
                    if($operaciones->nuevaClave($_POST))
                    {
                        $result['status']   = true;
                        $result['mensaje']  = 'La operación se realizó de manera satisfactoria.';
                    }
                    else
                    {
                        $errores = CHtml::errorSummary($operaciones->model);
                        throw new Exception($errores);
                    }
                    
                break;
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
    
    
    
    public function actionOperacionAgentes()
    {
        //header('Content-type: application/json');
        $result = array();
        try
        {
            
            $vista = "";
            $this->layout = "dialogo";
            $operaciones = new OperacionesAgentes($this);
            $result = $operaciones->init()->result;
            
            
        }
        catch (Exception $e)
        {
            $result['status'] = false;
            $result['mensaje'] = $e->getMessage();
        }
        
        header('Content-type: application/json');
        die(json_encode($result));
    }
    
    
}