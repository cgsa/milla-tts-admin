<?php

/**
 * This is the model class for table "usr_preguntas".
 *
 * The followings are the available columns in table 'usr_preguntas':
 * @property integer $id
 * @property string $doc_deudor
 * @property string $pregunta
 * @property string $fecha_registro
 * @property integer $idestadopregunta
 *
 * The followings are the available model relations:
 * @property UsrOpcionesRespuesta[] $usrOpcionesRespuestas
 */
class Preguntas extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usr_preguntas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('doc_deudor, pregunta, fecha_registro', 'required'),
			array('idestadopregunta', 'numerical', 'integerOnly'=>true),
			array('doc_deudor', 'length', 'max'=>20),
			array('pregunta', 'length', 'max'=>250),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, doc_deudor, pregunta, fecha_registro, idestadopregunta', 'safe', 'on'=>'search'),
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
			'usrOpcionesRespuestas' => array(self::HAS_MANY, 'UsrOpcionesRespuesta', 'idpregunta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'doc_deudor' => 'Doc Deudor',
			'pregunta' => 'Pregunta',
			'fecha_registro' => 'Fecha Registro',
			'idestadopregunta' => 'Idestadopregunta',
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
		$criteria->compare('doc_deudor',$this->doc_deudor,true);
		$criteria->compare('pregunta',$this->pregunta,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('idestadopregunta',$this->idestadopregunta);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Preguntas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
