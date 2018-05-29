<?php 
class OperacionesClave
{
    
    public $model;
    
    public function __construct(){}
    
    
    public function nuevaClave($post)
    {
        
        $this->model = $this->getModel();       
        
        if (isset($post[CrugeUtil::config()->postNameMappings['CrugeStoredUser']])) 
        {
            $this->model->attributes = $post[CrugeUtil::config()->postNameMappings['CrugeStoredUser']];
            if ($this->model->validate()) 
            {
                
                // el modelo ICrugeStoredUser ha validado bien, incluso cada uno de sus campos extra
                
                /*
                 si se ha especificado algun valor en $model->newPassword se asume
                 que se quiere cambiar la clave:
                 */
                $newPwd = trim($this->model->newPassword);
                Yii::log("deteccion de nueva clave: newPassword: [" . $newPwd . "]", "info");
                
                if( $newPwd != '' )
                {
                    Yii::log("\n\n***NUEVA CLAVE***\n\n", "info");
                    Yii::app()->user->um->changePassword($this->model, $newPwd);
                    
                    if (Yii::app()->user->um->save($this->model, 'update')) 
                    {
                        return true;
                    }
                    
                }                
                
            }
        }
        
        return false;
        
        
    }
    
    
    
    public function getModel()
    {
        return Yii::app()->user->um->loadUserById(Yii::app()->user->id,true);   
    }
}
