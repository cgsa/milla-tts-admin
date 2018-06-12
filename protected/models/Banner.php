<?php

/**
 * This is the model class for table "banner".
 *
 * The followings are the available columns in table 'banner':
 * @property integer $id
 * @property integer $id_imagen
 * @property string $nombre
 * @property string $descripcion
 * @property integer $status
 * @property string $fecha_registro
 * @property string $controlador
 * @property integer $id_contralador
 *
 * The followings are the available model relations:
 * @property Imagenes $idImagen
 */
class Banner extends CActiveRecord
{
    
    public $Filedata;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'banner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_imagen, nombre', 'required'),
			array('id_imagen, status, id_contralador', 'numerical', 'integerOnly'=>true),
			array('nombre, descripcion', 'length', 'max'=>100),
			array('controlador', 'length', 'max'=>30),
		    array('fecha_registro', 'safe'),
		    array('Filedata', 'file', 'types'=>'jpg,jpeg,gif,png', 'safe' => false,'allowEmpty' => true),
		    array('fecha_registro', 'default','value'=>new CDbExpression('NOW()'),'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_imagen, nombre, descripcion, status, fecha_registro, controlador, id_contralador', 'safe', 'on'=>'search'),
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
			'idImagen' => array(self::BELONGS_TO, 'Imagenes', 'id_imagen'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_imagen' => 'Id Imagen',
			'nombre' => 'Nombre',
			'descripcion' => 'Descripcion',
			'status' => 'Status',
			'fecha_registro' => 'Fecha Registro',
			'controlador' => 'Controlador',
			'id_contralador' => 'Valor',
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
		$criteria->compare('id_imagen',$this->id_imagen);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('controlador',$this->controlador,true);
		$criteria->compare('id_contralador',$this->id_contralador);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Banner the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
