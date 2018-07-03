<?php

/**
 * This is the model class for table "galeria_destino".
 *
 * The followings are the available columns in table 'galeria_destino':
 * @property integer $id
 * @property integer $id_destino
 * @property integer $id_imagen
 * @property integer $es_principal
 * @property integer $es_active
 *
 * The followings are the available model relations:
 * @property Destinos $idDestino
 * @property Imagenes $idImagen
 */
class GaleriaDestino extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'galeria_destino';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_destino, id_imagen', 'required'),
			array('id_destino, id_imagen, es_principal, es_active', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_destino, id_imagen, es_principal, es_active', 'safe', 'on'=>'search'),
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
			'idDestino' => array(self::BELONGS_TO, 'Destinos', 'id_destino'),
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
			'id_destino' => 'Id Destino',
			'id_imagen' => 'Id Imagen',
			'es_principal' => 'Es Principal',
			'es_active' => 'Es Active',
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
		$criteria->compare('id_destino',$this->id_destino);
		$criteria->compare('id_imagen',$this->id_imagen);
		$criteria->compare('es_principal',$this->es_principal);
		$criteria->compare('es_active',$this->es_active);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GaleriaDestino the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
