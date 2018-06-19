<?php

/**
 * This is the model class for table "usr_mensajes_interno".
 *
 * The followings are the available columns in table 'usr_mensajes_interno':
 * @property integer $id
 * @property integer $iduser
 * @property integer $iddeudahistorico
 * @property string $pregunta
 * @property string $respuesta
 * @property string $fecha_registro
 * @property string $fecha_respuesta
 *
 * The followings are the available model relations:
 * @property CrugeUser $iduser0
 * @property UsrDeudasHistorico $iddeudahistorico0
 */
class MensajesInterno extends CActiveRecord
{
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usr_mensajes_interno';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('iddeudahistorico, pregunta', 'required'),
			array('iduser, iddeudahistorico', 'numerical', 'integerOnly'=>true),
			array('respuesta, fecha_registro, fecha_respuesta', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, iduser, iddeudahistorico, pregunta, respuesta, fecha_registro, fecha_respuesta', 'safe', 'on'=>'search'),
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
			'iduser0' => array(self::BELONGS_TO, 'CrugeUser', 'iduser'),
			'iddeudahistorico0' => array(self::BELONGS_TO, 'DeudasHistorico', 'iddeudahistorico'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'iduser' => 'Iduser',
			'iddeudahistorico' => 'Iddeudahistorico',
			'pregunta' => 'Pregunta',
			'respuesta' => 'Respuesta',
			'fecha_registro' => 'Fecha Registro',
			'fecha_respuesta' => 'Fecha Respuesta',
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
		$criteria->compare('iduser',$this->iduser);
		$criteria->compare('iddeudahistorico',$this->iddeudahistorico);
		$criteria->compare('pregunta',$this->pregunta,true);
		$criteria->compare('respuesta',$this->respuesta,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('fecha_respuesta',$this->fecha_respuesta,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	
	public function getPreguntasDeudas()
	{
	    $criteria=new CDbCriteria;
	    //$criteria->select = "d.documento,d.nroproducto,d.monto_total, d.fecha_atraso ,t.*";
	    $criteria->join = "LEFT JOIN usr_deudas_historico d ON d.id = t.iddeudahistorico";
	    $criteria->condition = "d.identidad = ".(int)Yii::app()->user->getState('entidad');
	    $criteria->order = "t.respuesta IS NOT NULL";
	    return $this->findAll($criteria);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return MensajesInterno the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
