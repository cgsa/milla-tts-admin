<?php

/**
 * This is the model class for table "promociones".
 *
 * The followings are the available columns in table 'promociones':
 * @property integer $id
 * @property integer $id_lugar
 * @property string $titulo
 * @property string $descripcion
 * @property integer $total_millas
 * @property integer $cant_pasajes
 * @property integer $id_imagen
 * @property integer $status
 * @property string $fecha_fin
 * @property string $fecha_registro
 * @property string $hash
 *
 * The followings are the available model relations:
 * @property CuotasPromocion[] $cuotasPromocions
 * @property GaleriaPromocion[] $galeriaPromocions
 * @property PromocionUsuario[] $promocionUsuarios
 * @property Destinos $idLugar
 * @property Imagenes $idImagen
 */
class Promociones extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'promociones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_lugar,total_millas', 'required'),
			array('id_lugar, total_millas, cant_pasajes, id_imagen, status', 'numerical', 'integerOnly'=>true),
			array('titulo, hash', 'length', 'max'=>100),
		    array('descripcion, fecha_fin, fecha_registro', 'safe'),
		    array('fecha_registro', 'default','value'=>new CDbExpression('NOW()'),'on'=>'insert'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_lugar, titulo, descripcion, total_millas, cant_pasajes, id_imagen, status, fecha_fin, fecha_registro, hash', 'safe', 'on'=>'search'),
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
			'cuotasPromocions' => array(self::HAS_MANY, 'CuotasPromocion', 'id_promocion'),
			'galeriaPromocions' => array(self::HAS_MANY, 'GaleriaPromocion', 'id_promocion'),
			'promocionUsuarios' => array(self::HAS_MANY, 'PromocionUsuario', 'id_promocion'),
			'idLugar' => array(self::BELONGS_TO, 'Destinos', 'id_lugar'),
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
			'id_lugar' => 'Ciudad',
			'titulo' => 'Titulo',
			'descripcion' => 'Descripción',
			'total_millas' => 'Total Millas',
			'cant_pasajes' => 'Cant Pasajes',
			'id_imagen' => 'Imagen',
			'status' => 'Status',
			'fecha_fin' => 'Fecha Fin',
			'fecha_registro' => 'Fecha Registro',
			'hash' => 'Hash',
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
		$criteria->compare('id_lugar',$this->id_lugar);
		$criteria->compare('titulo',$this->titulo,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('total_millas',$this->total_millas);
		$criteria->compare('cant_pasajes',$this->cant_pasajes);
		$criteria->compare('id_imagen',$this->id_imagen);
		$criteria->compare('status',$this->status);
		$criteria->compare('fecha_fin',$this->fecha_fin,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('hash',$this->hash,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Promociones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	public function beforeSave() {
	    
	    if ($this->isNewRecord)
	    {
	        $time = new CDbExpression('NOW()');
	        $hash = md5($time.$this->titulo);
	        $this->hash = $hash;
	    }
	    
	    return parent::beforeSave();
	}
}
