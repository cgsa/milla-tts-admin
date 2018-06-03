<?php

/**
 * This is the model class for table "usr_deudas_historico".
 *
 * The followings are the available columns in table 'usr_deudas_historico':
 * @property integer $id
 * @property integer $identidad
 * @property string $documento
 * @property string $nroproducto
 * @property string $monto_total
 * @property string $data_json
 * @property string $fecha_atraso
 * @property string $fecha_registro
 *
 * The followings are the available model relations:
 * @property UsrEntidades $identidad0
 * @property UsrMensajesInterno[] $usrMensajesInternos
 */
class DeudasHistorico extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usr_deudas_historico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('identidad, documento, nroproducto, monto_total, fecha_atraso, fecha_registro', 'required'),
			array('identidad', 'numerical', 'integerOnly'=>true),
			array('documento', 'length', 'max'=>20),
			array('nroproducto', 'length', 'max'=>30),
			array('monto_total', 'length', 'max'=>25),
			array('data_json', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identidad, documento, nroproducto, monto_total, data_json, fecha_atraso, fecha_registro', 'safe', 'on'=>'search'),
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
			'identidad0' => array(self::BELONGS_TO, 'UsrEntidades', 'identidad'),
			'usrMensajesInternos' => array(self::HAS_MANY, 'MensajesInterno', 'iddeudahistorico'),
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
			'documento' => 'Documento',
			'nroproducto' => 'Nroproducto',
			'monto_total' => 'Monto Total',
			'data_json' => 'Data Json',
			'fecha_atraso' => 'Fecha Atraso',
			'fecha_registro' => 'Fecha Registro',
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
		$criteria->compare('documento',$this->documento,true);
		$criteria->compare('nroproducto',$this->nroproducto,true);
		$criteria->compare('monto_total',$this->monto_total,true);
		$criteria->compare('data_json',$this->data_json,true);
		$criteria->compare('fecha_atraso',$this->fecha_atraso,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DeudasHistorico the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
