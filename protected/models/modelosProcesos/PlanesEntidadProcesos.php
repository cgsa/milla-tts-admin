<?php
class PlanesEntidadProcesos 
{
    
    public $criteria;
    
    private $model;
    
    private $post;
    
    
    
    
    public function iniciarCarga($post)
    {
        $this->model = new PlanesEntidad;
        $this->post = $post;        
        
        return $this;
        
    }
    
    
    
    public function activar()
    {
        $result = $this->insertar();
        
        if($result != 1)
        {
            $this->setException(0);
        }
        
        
        return (int)$result;
    }
    
    
    public function setException($cod)
    {
        $mensaje = "";
        
        switch ($cod) {
            case 0:
                $mensaje = "El plan seleccionado se encuentra activo.";
            break;
            case -1:
                $mensaje = "Ocurrió un error en la activacón del plan.";
            break;
        }
        
        throw new Exception($mensaje);
    }
    
    
    
    public function insertar()
    {
       
        $result = -1;
        
        if(!$this->model->planActivo($this->post['id']))
        {
            
            try 
            {
                
                $json['config'] = $this->getJson();
                $this->model->identidad = Yii::app()->user->getState('entidad');
                $this->model->idplan = $this->post['id'];
                $this->model->config_json = json_encode($json);
                $this->model->fecha_ini = date("Y-m-d");
                $this->model->idestadoplanentidad = 1;
                
                $result = $this->saveData();
                Yii::app()->user->setState($this->model->idplan0->idherramienta0->codigo,$this->post['id']);
                
            } 
            catch (Exception $e) 
            {
                $errores = CHtml::errorSummary($this->model);
                return $errores;
            }
        }
        
        return $result;
    }
    
    
    public function saveForSystemAdmin()
    {
        $result = 0;
        
        if(isset($this->post['PlanesEntidad']))
        {
            $this->model->attributes = $this->post['PlanesEntidad'];
            $json['config'] = $this->getJson();            
            $this->model->config_json = json_encode($json);
            $this->model->fecha_ini = (empty($this->model->fecha_ini))? date("Y-m-d") : $this->model->fecha_ini;
            $this->model->fecha_fin = (empty($this->model->fecha_fin))? null : $this->model->fecha_fin;
            $result = $this->saveData();
        }
        
        return $result;
        
    }
    
    
    private function saveData()
    {
        if($this->model->save())
        {
            return 1;
        }
        
        return -1;
    }
    
    
    public function loadData($row = "single")
    {  
        $model = "";
        
        switch ($row)
        {
            case 'all':
                $model = $this->model->findAll( $this->filter() );
            break;
            default:
                $model = $this->model->find( $this->filter() );
        }
        
        $this->model = $model;
    }
    
    
    public function isActiveTool()
    {
        $row = $this->model->find( $this->filter() );
        
        if( is_null($row) )
        {
            return false;
        }
        
        return true; 
    }
    
    
    public function findDataCombo()
    {
        $data = "<option value='' >--Seleccione--</option>";
        
        if(!$this->isActiveTool())
        {
            $criteria = new CDbCriteria;
            $criteria->condition = "idherramienta = ".$this->post['id'];
            $rows = Planes::model()->findAll($criteria);
            
            foreach ($rows AS $key=>$value)
            {
                $data .= "<option value='".$value->id."' >".$value->nombre."</option>";
            }
        }
        
        return $data;
        
    }
    
    
    public function findDataJson()
    {
        
        $row = Herramientas::model()->findByPk($this->post['id']);        
        $data = "";
        
        if(!is_null($row))
        {
            $json = $row->json_config;
            $array = (empty($json))? "" : json_decode($json)->config;
            
            foreach ($array AS $key=>$value)
            {
                $data .= "<dt class='col-sm-6'>$key</dt>";
                $data .= "<dd class='col-sm-6'><input type='text' class='form-control' name='config[$key]' value='$value' /></dd>";
            }
        }        
        
        return $data;
        
    }
    
    
    private function filter()
    {
        $criteria = new CDbCriteria;        
        
        switch ($this->post['action'])
        {
            case 'LP':
                $criteria->select  = "t.id, t.fecha_fin, t.fecha_ini,p.nombre as plan,p.id as idplan, h.nombre as herramienta";
                $criteria->join = " LEFT JOIN planes p ON p.id = t.idplan";
                $criteria->join .= " LEFT JOIN herramientas h ON h.id = p.idherramienta";
                $criteria->condition  = "t.identidad = ".$this->post['id'];
                $criteria->condition .= " AND t.idestadoplanentidad = 1";
            break;
            case 'PP':
                $criteria->select  = "t.*,p.id as idplan,h.*";
                $criteria->join = "LEFT JOIN planes p ON p.id = t.idplan";
                $criteria->join .= " LEFT JOIN herramientas h ON h.id = p.idherramienta";
                $criteria->condition   = " t.identidad = ".$this->post['entidad'];
                $criteria->condition  .= " AND p.idherramienta = ".$this->post['id'];
                $criteria->condition  .= " AND t.idestadoplanentidad = 1";
            break;
            case 'UPP':
                $criteria->condition  = "id = ".$this->post['id'];
            break;
            default:
                $criteria->condition  = "idplan = ".$this->post['id'];
                $criteria->condition .= " AND identidad = ".Yii::app()->user->getState('entidad');
            break;
        }        
        
        return $criteria;        
        
    }
    
    
    public function update()
    {
        $result = -1;
        $this->model = $this->model->findByPk($this->post['id']);
        $json['config'] = $this->post['config'];
        $this->model->config_json = json_encode($json);
        if($this->model->save())
        {
            $result = 1;
        }
        
        return $result;
    }
    
    
    private function getJson()
    {
        $row = Planes::model()->findByPk($this->post['id']);
        $json = $row->idherramienta0->json_config;
        
        return (empty($json))? "" : json_decode($json)->config;
    }
    
    
    
    public function getModel()
    {
        return $this->model;
    }
    
    
    
}