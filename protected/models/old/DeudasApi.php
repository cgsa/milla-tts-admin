<?php

/**
 * This is the model class for table "usr_deudas_api".
 *
 * The followings are the available columns in table 'usr_deudas_api':
 * @property integer $id
 * @property string $codproducto
 * @property integer $idclasificacion
 * @property string $codentidad
 * @property string $doc_deudor
 * @property string $deuda_total
 * @property string $json_complemento
 * @property string $fecha_atraso
 * @property string $fecha_lote
 * @property string $fecha_registro
 * @property integer $idestadodeuda
 *
 * The followings are the available model relations:
 * @property StdClasificacionDeudores $idclasificacion0
 */
class DeudasApi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usr_deudas_api';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('codproducto, idclasificacion, codentidad, doc_deudor, fecha_registro', 'required'),
			array('idclasificacion, idestadodeuda', 'numerical', 'integerOnly'=>true),
			array('codproducto, codentidad, doc_deudor, deuda_total', 'length', 'max'=>20),
			array('json_complemento, fecha_atraso, fecha_lote', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, codproducto, idclasificacion, codentidad, doc_deudor, deuda_total, json_complemento, fecha_atraso, fecha_lote, fecha_registro, idestadodeuda', 'safe', 'on'=>'search'),
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
			'idclasificacion0' => array(self::BELONGS_TO, 'StdClasificacionDeudores', 'idclasificacion'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'codproducto' => 'Codproducto',
			'idclasificacion' => 'Idclasificacion',
			'codentidad' => 'Codentidad',
			'doc_deudor' => 'Doc Deudor',
			'deuda_total' => 'Deuda Total',
			'json_complemento' => 'Json Complemento',
			'fecha_atraso' => 'Fecha Atraso',
			'fecha_lote' => 'Fecha Lote',
			'fecha_registro' => 'Fecha Registro',
			'idestadodeuda' => 'Idestadodeuda',
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
		$criteria->compare('codproducto',$this->codproducto,true);
		$criteria->compare('idclasificacion',$this->idclasificacion);
		$criteria->compare('codentidad',$this->codentidad,true);
		$criteria->compare('doc_deudor',$this->doc_deudor,true);
		$criteria->compare('deuda_total',$this->deuda_total,true);
		$criteria->compare('json_complemento',$this->json_complemento,true);
		$criteria->compare('fecha_atraso',$this->fecha_atraso,true);
		$criteria->compare('fecha_lote',$this->fecha_lote,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('idestadodeuda',$this->idestadodeuda);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DeudasApi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
