<?php

/**
 * This is the model class for table "galeria_promocion".
 *
 * The followings are the available columns in table 'galeria_promocion':
 * @property integer $id
 * @property integer $id_promocion
 * @property integer $id_imagen
 * @property integer $es_principal
 *
 * The followings are the available model relations:
 * @property Imagenes $idImagen
 * @property Promociones $idPromocion
 */
class GaleriaPromocion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'galeria_promocion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_promocion, id_imagen', 'required'),
			array('id_promocion, id_imagen, es_principal', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_promocion, id_imagen, es_principal', 'safe', 'on'=>'search'),
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
			'idPromocion' => array(self::BELONGS_TO, 'Promociones', 'id_promocion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_promocion' => 'Id Promocion',
			'id_imagen' => 'Id Imagen',
			'es_principal' => 'Es Principal',
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
		$criteria->compare('id_promocion',$this->id_promocion);
		$criteria->compare('id_imagen',$this->id_imagen);
		$criteria->compare('es_principal',$this->es_principal);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GaleriaPromocion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
