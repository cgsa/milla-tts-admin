<?php

/**
 * This is the model class for table "pagos_promociones".
 *
 * The followings are the available columns in table 'pagos_promociones':
 * @property integer $id
 * @property integer $id_promocion_usuario
 * @property string $cod_cupon
 * @property string $fecha_pago
 * @property string $cod_pago
 * @property string $reference_id
 * @property string $extra
 * @property integer $id_user
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property CrugeUser $idUser
 * @property PromocionUsuario $idPromocionUsuario
 */
class PagosPromociones extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'pagos_promociones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_promocion_usuario, cod_cupon, fecha_pago', 'required'),
			array('id_promocion_usuario, id_user, status', 'numerical', 'integerOnly'=>true),
			array('cod_cupon, cod_pago, reference_id', 'length', 'max'=>100),
			array('extra', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_promocion_usuario, cod_cupon, fecha_pago, cod_pago, reference_id, extra, id_user, status', 'safe', 'on'=>'search'),
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
			'idUser' => array(self::BELONGS_TO, 'CrugeUser', 'id_user'),
			'idPromocionUsuario' => array(self::BELONGS_TO, 'PromocionUsuario', 'id_promocion_usuario'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_promocion_usuario' => 'Id Promocion Usuario',
			'cod_cupon' => 'Cod Cupon',
			'fecha_pago' => 'Fecha Pago',
			'cod_pago' => 'Cod Pago',
			'reference_id' => 'Reference',
			'extra' => 'Extra',
			'id_user' => 'Id User',
			'status' => 'Status',
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
		$criteria->compare('id_promocion_usuario',$this->id_promocion_usuario);
		$criteria->compare('cod_cupon',$this->cod_cupon,true);
		$criteria->compare('fecha_pago',$this->fecha_pago,true);
		$criteria->compare('cod_pago',$this->cod_pago,true);
		$criteria->compare('reference_id',$this->reference_id,true);
		$criteria->compare('extra',$this->extra,true);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PagosPromociones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
