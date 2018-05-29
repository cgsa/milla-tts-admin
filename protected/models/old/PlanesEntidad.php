<?php

/**
 * This is the model class for table "usr_planes_entidad".
 *
 * The followings are the available columns in table 'usr_planes_entidad':
 * @property integer $id
 * @property integer $identidad
 * @property integer $idplan
 * @property string $config_json
 * @property string $fecha_ini
 * @property string $fecha_fin
 * @property integer $idestadoplanentidad
 *
 * The followings are the available model relations:
 * @property Planes $idplan0
 * @property UsrEntidades $identidad0
 */
class PlanesEntidad extends CActiveRecord
{
    
    public $data;
    
    
    public $idherramienta;
    
    public $herramienta;
    
    public $plan;
    
    public $json_config;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usr_planes_entidad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('identidad, idplan', 'required'),
			array('identidad, idplan, idestadoplanentidad', 'numerical', 'integerOnly'=>true),
			array('config_json, fecha_ini, fecha_fin', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identidad, idplan, config_json, fecha_ini, fecha_fin, idestadoplanentidad', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idplan0' => array(self::BELONGS_TO, 'Planes', 'idplan'),
			'identidad0' => array(self::BELONGS_TO, 'UsrEntidades', 'identidad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'identidad' => 'Identidad',
			'idplan' => 'Plan',
			'config_json' => 'Configuración JSON',
			'fecha_ini' => 'Fecha Inicio',
			'fecha_fin' => 'Fecha Fin',
			'idestadoplanentidad' => 'Idestadoplanentidad',
		    'idherramienta'=>'Herramienta'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('identidad',$this->identidad);
		$criteria->compare('idplan',$this->idplan);
		$criteria->compare('config_json',$this->config_json,true);
		$criteria->compare('fecha_ini',$this->fecha_ini,true);
		$criteria->compare('fecha_fin',$this->fecha_fin,true);
		$criteria->compare('idestadoplanentidad',$this->idestadoplanentidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function planActivo( $idPlan, $identidad = false )
	{
	    
	    $entidad = ($identidad != false)? $identidad : Yii::app()->user->getState('entidad'); 
	    $criteria = new CDbCriteria;
	    $criteria->condition  = "idplan = ".$idPlan;
	    $criteria->condition .= " AND identidad = ".$entidad;
	    $criteria->condition .= " AND idestadoplanentidad = 1";
	    $row = $this->find($criteria);
	    
	    if(!is_null($row))
	    {
	        return true;
	    }
	    
	    return false;	    
	}
	
	
	
	public function checkPlan($obj)
	{
	    $result = "";
	    
	    switch ($obj->idopcionpago)
	    {
	        case 3:
	            $result = $this->getConfiguracion(true, $obj);
	        break;	        
	        default:
	            
	            if( Yii::app()->user->hasState($obj->idherramienta0->codigo) )
	            {
	                
	                if(Yii::app()->user->getState($obj->idherramienta0->codigo) == $obj->id)
	                {
	                    
	                    $result = $this->getConfiguracion(false, $obj);
	                }
	                
	            }
	            else
	            {
	                $result = $this->getBotonActivar($obj);
	            }
	    }
	    
	    return $result;
	}
	
	
	
	public function clearVariableHerramientas()
	{
	    $herramienta = Herramientas::model()->findAll();
	    
	    foreach($herramienta as $key=>$value)
	    {
	        Yii::app()->user->setState($value->codigo, null);
	    }
	}
	
	
	protected function getBotonActivar($obj)
	{
	    return '<a href="#" data-name="'.$obj->nombre.'" data-id="'.$obj->id.'" class="btn btn-default cls_activacion_plan">
                Activar
                </a>';
	}
	
	
	protected function getConfiguracion($opc = false,$obj)
	{
	    $html = '';
	    
	    if($opc)
	    {
	        $html .= '<h5 class="card-title">Temporal Finaliza: '.$obj->fecha_desactivar.'</h5>';
	    }
	    $html = '
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle"
                  data-toggle="dropdown">
            Activo <span class="caret"></span>
          </button>
         
          <ul class="dropdown-menu" role="menu">
            <li><a href="#" data-id="'.$obj->id.'" class="cls_config_plan" data-action="CP" >Configuración</a></li>
            <li><a href="#" data-id="'.$obj->id.'" class="cls_config_plan" data-opcion="CC" >Cancelar Plan</a></li>
          </ul>
        </div>';
	    
	    return $html;
	} 
	
	
	public function startHerramientasActivas()
	{
	    $criteria = new CDbCriteria;
	    $criteria->condition = "identidad = ".Yii::app()->user->getState('entidad');
	    $criteria->condition .= " AND idestadoplanentidad = 1";
	    $rows = $this->findAll($criteria);
	    //var_dump($value);die;
	    foreach($rows as $key=>$value)
	    {
	        Yii::app()->user->setState($value->idplan0->idherramienta0->codigo,$value->idplan);
	    }
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PlanesEntidad the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
