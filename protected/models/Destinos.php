<?php

/**
 * This is the model class for table "destinos".
 *
 * The followings are the available columns in table 'destinos':
 * @property integer $id
 * @property string $nombre
 * @property string $ciudad
 * @property string $descripcion
 * @property string $coodenadas
 * @property integer $status
 * @property string $fecha_registro
 * @property string $hash
 *
 * The followings are the available model relations:
 * @property GaleriaDestino[] $galeriaDestinos
 * @property Promociones[] $promociones
 */
class Destinos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'destinos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, ciudad', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('nombre, ciudad, coodenadas, hash', 'length', 'max'=>100),
		    array('descripcion, fecha_registro', 'safe'),
		    array('fecha_registro', 'default','value'=>new CDbExpression('NOW()'),'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre, ciudad, descripcion, coodenadas, status, fecha_registro, hash', 'safe', 'on'=>'search'),
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
			'galeriaDestinos' => array(self::HAS_MANY, 'GaleriaDestino', 'id_destino'),
			'promociones' => array(self::HAS_MANY, 'Promociones', 'id_lugar'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Id',
			'nombre' => 'Nombre',
			'ciudad' => 'Ciudad',
			'descripcion' => 'Descripcion',
			'coodenadas' => 'Coodenadas',
			'status' => 'Status',
			'fecha_registro' => 'Fecha Registro',
			'hash' => 'Hash',
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
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('ciudad',$this->ciudad,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('coodenadas',$this->coodenadas,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hash',$this->hash,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Destinos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	public function beforeSave() {
	    
	    if (empty($this->hash))
	    {
	        $time = new CDbExpression('NOW()');
	        $hash = md5($time.$this->nombre);
	        $this->hash = $hash;
	    }
	    
	    return parent::beforeSave();
	}
	
}
