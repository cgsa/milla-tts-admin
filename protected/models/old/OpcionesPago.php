<?php

/**
 * This is the model class for table "usr_opciones_pago".
 *
 * The followings are the available columns in table 'usr_opciones_pago':
 * @property integer $id
 * @property string $id_unica_deuda
 * @property integer $nro_cuota
 * @property string $monto_cuota
 * @property string $link_cuota
 * @property string $codigo_cupon
 * @property string $fecha_vencimiento
 */
class OpcionesPago extends CActiveRecord
{
    
    public $filename;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usr_opciones_pago';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_unica_deuda, nro_cuota, monto_cuota, codigo_cupon, fecha_vencimiento', 'required'),
		    array('nro_cuota', 'numerical', 'integerOnly'=>true),
		    array('filename', 'file', 'types'=>'xls,csv', 'safe' => false,'allowEmpty' => true),
			array('id_unica_deuda, monto_cuota', 'length', 'max'=>20),
			array('link_cuota', 'length', 'max'=>150),
			array('codigo_cupon', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_unica_deuda, nro_cuota, monto_cuota, link_cuota, codigo_cupon, fecha_vencimiento', 'safe', 'on'=>'search'),
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
			'id_unica_deuda' => 'Id Unica Deuda',
			'nro_cuota' => 'Nro Cuota',
			'monto_cuota' => 'Monto Cuota',
			'link_cuota' => 'Link Cuota',
			'codigo_cupon' => 'Codigo Cupon',
		    'fecha_vencimiento' => 'Fecha Vencimiento',
		    'filename' =>'Archivo',
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
		$criteria->compare('id_unica_deuda',$this->id_unica_deuda,true);
		$criteria->compare('nro_cuota',$this->nro_cuota);
		$criteria->compare('monto_cuota',$this->monto_cuota,true);
		$criteria->compare('link_cuota',$this->link_cuota,true);
		$criteria->compare('codigo_cupon',$this->codigo_cupon,true);
		$criteria->compare('fecha_vencimiento',$this->fecha_vencimiento,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return OpcionesPago the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
