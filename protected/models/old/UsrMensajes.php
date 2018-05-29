<?php

/**
 * This is the model class for table "usr_mensajes".
 *
 * The followings are the available columns in table 'usr_mensajes':
 * @property integer $id
 * @property integer $identidad
 * @property string $asunto
 * @property string $mensaje
 * @property integer $tipo
 * @property string $fecha_carga
 * @property integer $estadomensaje
 * @property integer $iduser
 * @property string $rfc_cliente
 * @property string $respuesta
 *
 * The followings are the available model relations:
 * @property UsrEntidades $identidad0
 */
class UsrMensajes extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usr_mensajes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('identidad, asunto, mensaje, tipo, rfc_cliente', 'required'),
			array('identidad, tipo, estadomensaje, iduser', 'numerical', 'integerOnly'=>true),
			array('asunto', 'length', 'max'=>255),
			array('rfc_cliente', 'length', 'max'=>50),
			array('fecha_carga, respuesta', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identidad, asunto, mensaje, tipo, fecha_carga, estadomensaje, iduser, rfc_cliente, respuesta', 'safe', 'on'=>'search'),
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
			'asunto' => 'Asunto',
			'mensaje' => 'Mensaje',
			'tipo' => 'Tipo',
			'fecha_carga' => 'Fecha Carga',
			'estadomensaje' => 'Estadomensaje',
			'iduser' => 'Iduser',
			'rfc_cliente' => 'Rfc Cliente',
			'respuesta' => 'Respuesta',
		);
	}
	
	public function getInfoUsuario($rfc)
	{
	    $model = new UsrDeudas;
	    $criteria=new CDbCriteria;
	    $criteria->condition = "rfc_cliente = '".$rfc."'";
	    return $model->find($criteria);
	}
	
	
	public function getMensajesUsuarios($id = null)
	{
	    $model = new UsrMensajes;
	    $criteria=new CDbCriteria;
	    $criteria->condition = "rfc_cliente = '".Yii::app()->user->getState('rfc')."'";
	    
	    if($id != null && is_numeric($id))
	    {
	        $criteria->condition .= " AND identidad = ".$id;
	    }
	    
	    return $model->findAll($criteria);
	}
	
	
	
	public function getTipoMensaje($id)
	{
	    $result = "";
	    switch ($id)
	    {
	        case 0:
	            $result = "ENTIDAD-USUARIO";
	            break;
	        case 1:
	            $result = "USUARIO-ENTIDAD";
	            breaK;
	    }
	    
	    return $result;
	}
	
	
	
	
	public function getDeudasActivas()
	{
	    $model = new UsrDeudasLotesRepository;
	    $criteria=new CDbCriteria;
	    $criteria->condition = "idestadoregistro = 0";
	    
	    if(Yii::app()->user->checkAccess('USER-AGENTE') && Yii::app()->user->hasState('entidada'))
	    {
	        $criteria->condition .= " AND identidad = ".Yii::app()->user->getState('entidada');
	    }
	    else if(Yii::app()->user->checkAccess('USER-SISTEMA'))
	    {
	        $criteria->condition .= " AND rfc_cliente = '".Yii::app()->user->getState('rfc')."'";
	    }
	    
	    
	    return $model->modelo->findAll($criteria);
	}
	
	
	
	public function getInfoEntidad($id)
	{
	    $model = new UsrEntidades;
	    return $model->findByPk($id);
	}
	
	
	public function getEstadoMensaje($id)
	{
	    $result = "";
	    switch ($id)
	    {
	        case 0:
	            $result = "Sin leer";
	            break;
	        case 1:
	            $result = "Leído";
	            breaK;
	        case 2:
	            $result = "Procesado";
	            breaK;
	        case 3:
	            $result = "Eliminado por el usuario";
	            breaK;
	        case 4:
	            $result = "Leído por el usuario";
	            breaK;
	        case 5:
	            $result = "Posible Pago";
	            breaK;
	        case 6:
	            $result = "Cerrado";
	            breaK;
	    }
	    
	    return $result;
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
		$criteria->compare('asunto',$this->asunto,true);
		$criteria->compare('mensaje',$this->mensaje,true);
		$criteria->compare('tipo',$this->tipo);
		$criteria->compare('fecha_carga',$this->fecha_carga,true);
		$criteria->compare('estadomensaje',$this->estadomensaje);
		$criteria->compare('iduser',$this->iduser);
		$criteria->compare('rfc_cliente',$this->rfc_cliente,true);
		$criteria->compare('respuesta',$this->respuesta,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsrMensajes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
