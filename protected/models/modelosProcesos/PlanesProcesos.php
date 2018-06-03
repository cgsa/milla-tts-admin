<?php


class PlanesProcesos
{
    
    
    public $criteria;
    
    private $model;
    
    private $post;
    
    
    
    public function iniciarCarga($post)
    {        
        $this->model = new Planes;
        $this->post = $post;
        
        switch($post['action'])
        {
            case 'UP':
            case 'JSON':
                //$this->parametros($this->post['id']);
                $row = $this->model->findByPk($this->post['id']);
                
                if(!is_null($row))
                {
                    $this->model = $row;
                }
                
            break;
        }
        
        return $this;
        
    }
    
    
    private function parametros($id)
    {
        if(is_numeric($id))
        {
            $this->criteria = new CDbCriteria;
            $this->criteria->condition = "id = ".$id;
            return true;
        }
        
        return false;
    }
    
    
    
    public function insertar( $schema )
    {
        $result = 0;
        
        if(isset($this->post[$schema]))
        {
            $this->model->attributes = $this->post[$schema];
            $result = -1;
            
            if($this->model->save())
            {
                $result = 1;
            }
            
        }
        
        return $result;
    }
    
    
    
    public function getModel()
    {
        return $this->model;
    }
    
    
    
    
}