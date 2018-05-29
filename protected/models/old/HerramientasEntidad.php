<?php

/**
 * This is the model class for table "herramientas_entidad".
 *
 * The followings are the available columns in table 'herramientas_entidad':
 * @property integer $id
 * @property integer $identidad
 * @property integer $idherramienta
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $fecha_registro
 * @property string $codigo_url
 *
 * The followings are the available model relations:
 * @property Herramientas $idherramienta0
 * @property UsrEntidades $identidad0
 */
class HerramientasEntidad extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'herramientas_entidad';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('identidad, idherramienta, fecha_inicio, fecha_fin, codigo_url', 'required'),
			array('identidad, idherramienta', 'numerical', 'integerOnly'=>true),
			array('codigo_url', 'length', 'max'=>15),
		    array('fecha_registro', 'safe'),
		    array('fecha_registro', 'default','value'=>new CDbExpression('NOW()'),'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identidad, idherramienta, fecha_inicio, fecha_fin, fecha_registro, codigo_url', 'safe', 'on'=>'search'),
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
			'idherramienta0' => array(self::BELONGS_TO, 'Herramientas', 'idherramienta'),
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
			'identidad' => 'Acreedor',
			'idherramienta' => 'Herramienta',
			'fecha_inicio' => 'Inicia',
			'fecha_fin' => 'Finaliza',
			'fecha_registro' => 'Fecha Registro',
			'codigo_url' => 'Codigo',
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
		$criteria->compare('idherramienta',$this->idherramienta);
		$criteria->compare('fecha_inicio',$this->fecha_inicio,true);
		$criteria->compare('fecha_fin',$this->fecha_fin,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('codigo_url',$this->codigo_url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return HerramientasEntidad the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
