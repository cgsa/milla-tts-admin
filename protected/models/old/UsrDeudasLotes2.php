<?php

/**
 * This is the model class for table "usr_deudas_lotes2".
 *
 * The followings are the available columns in table 'usr_deudas_lotes2':
 * @property integer $id
 * @property string $identificacion_unica_cliente
 * @property integer $identidad
 * @property string $nombre_cliente
 * @property string $rfc_cliente
 * @property string $clasificacion_cliente
 * @property string $fecha_atraso
 * @property string $fecha_lote
 * @property string $nro_producto
 * @property string $descripcion_deuda
 * @property string $deuda_total
 * @property string $fecha_carga
 * @property integer $idusuario_carga
 * @property integer $idestadoregistro
 */
class UsrDeudasLotes2 extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usr_deudas_lotes2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('identidad, idusuario_carga, idestadoregistro', 'numerical', 'integerOnly'=>true),
			array('identificacion_unica_cliente', 'length', 'max'=>22),
			array('nombre_cliente, rfc_cliente, clasificacion_cliente, nro_producto, descripcion_deuda', 'length', 'max'=>50),
			array('deuda_total', 'length', 'max'=>20),
			array('fecha_atraso, fecha_lote, fecha_carga', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identificacion_unica_cliente, identidad, nombre_cliente, rfc_cliente, clasificacion_cliente, fecha_atraso, fecha_lote, nro_producto, descripcion_deuda, deuda_total, fecha_carga, idusuario_carga, idestadoregistro', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'identificacion_unica_cliente' => 'Identificacion Unica Cliente',
			'identidad' => 'Identidad',
			'nombre_cliente' => 'Nombre Cliente',
			'rfc_cliente' => 'Rfc Cliente',
			'clasificacion_cliente' => 'Clasificacion Cliente',
			'fecha_atraso' => 'Fecha Atraso',
			'fecha_lote' => 'Fecha Lote',
			'nro_producto' => 'Nro Producto',
			'descripcion_deuda' => 'Descripcion Deuda',
			'deuda_total' => 'Deuda Total',
			'fecha_carga' => 'Fecha Carga',
			'idusuario_carga' => 'Idusuario Carga',
			'idestadoregistro' => 'Idestadoregistro',
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
		$criteria->compare('identificacion_unica_cliente',$this->identificacion_unica_cliente,true);
		$criteria->compare('identidad',$this->identidad);
		$criteria->compare('nombre_cliente',$this->nombre_cliente,true);
		$criteria->compare('rfc_cliente',$this->rfc_cliente,true);
		$criteria->compare('clasificacion_cliente',$this->clasificacion_cliente,true);
		$criteria->compare('fecha_atraso',$this->fecha_atraso,true);
		$criteria->compare('fecha_lote',$this->fecha_lote,true);
		$criteria->compare('nro_producto',$this->nro_producto,true);
		$criteria->compare('descripcion_deuda',$this->descripcion_deuda,true);
		$criteria->compare('deuda_total',$this->deuda_total,true);
		$criteria->compare('fecha_carga',$this->fecha_carga,true);
		$criteria->compare('idusuario_carga',$this->idusuario_carga);
		$criteria->compare('idestadoregistro',$this->idestadoregistro);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsrDeudasLotes2 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
