<?php

/**
 * This is the model class for table "promocion_usuario".
 *
 * The followings are the available columns in table 'promocion_usuario':
 * @property integer $id
 * @property integer $id_cuota_promocion
 * @property integer $id_user
 * @property string $fecha_registro
 * @property integer $id_promocion
 * @property string $total_millas
 * @property string $monto_total
 * @property integer $status
 *
 * The followings are the available model relations:
 * @property PagosPromociones[] $pagosPromociones
 * @property CrugeUser $idUser
 * @property CuotasPromocion $idCuotaPromocion
 * @property Promociones $idPromocion
 */
class PromocionUsuario extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'promocion_usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_cuota_promocion, id_user, id_promocion, total_millas, monto_total', 'required'),
			array('id_cuota_promocion, id_user, id_promocion, status', 'numerical', 'integerOnly'=>true),
			array('total_millas, monto_total', 'length', 'max'=>15),
			array('fecha_registro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_cuota_promocion, id_user, fecha_registro, id_promocion, total_millas, monto_total, status', 'safe', 'on'=>'search'),
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
			'pagosPromociones' => array(self::HAS_MANY, 'PagosPromociones', 'id_promocion_usuario'),
			'idUser' => array(self::BELONGS_TO, 'CrugeUser', 'id_user'),
			'idCuotaPromocion' => array(self::BELONGS_TO, 'CuotasPromocion', 'id_cuota_promocion'),
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
			'id_cuota_promocion' => 'Id Cuota Promocion',
			'id_user' => 'Id User',
			'fecha_registro' => 'Fecha Registro',
			'id_promocion' => 'Id Promocion',
			'total_millas' => 'Total Millas',
			'monto_total' => 'Monto Total',
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
		$criteria->compare('id_cuota_promocion',$this->id_cuota_promocion);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('id_promocion',$this->id_promocion);
		$criteria->compare('total_millas',$this->total_millas,true);
		$criteria->compare('monto_total',$this->monto_total,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	
	public function getStatusLiteral($status)
	{
	    $result = "";
	    switch ($status) {
	        case 0:
	            $result = "Pendiente";
	        break;	        
	        case 1:
	            $result = "Comprado";
	        break;
	        default:
	            $result = "Cancelado";
	    }
	    
	    return $result;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PromocionUsuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
