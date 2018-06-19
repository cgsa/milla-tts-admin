<?php

/**
 * This is the model class for table "usr_usuarios_agentes".
 *
 * The followings are the available columns in table 'usr_usuarios_agentes':
 * @property integer $id
 * @property integer $identidad
 * @property string $telefono_particular
 * @property string $telefono_movil
 * @property integer $estadoagente
 * @property string $fecha_carga
 * @property string $username
 * @property string $email
 * @property string $password
 *
 * The followings are the available model relations:
 * //@property CrugeUser $id0
 * @property UsrEntidades $identidad0
 */
class UsrUsuariosAgentes extends CActiveRecord
{
    public $username;
    
    public $email;    
    
    public $password;
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usr_usuarios_agentes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		    array('id,username,email,password', 'required','on' => 'create'),
		    array('email','length','max'=> 150),
		    array('email','email'),
		    array('username,email,password','length','max' => 50),
			array('id, identidad, estadoagente', 'numerical', 'integerOnly'=>true),
			array('telefono_particular, telefono_movil','length', 'max'=>50),
			array('fecha_carga', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identidad, telefono_particular, telefono_movil, estadoagente, fecha_carga', 'safe', 'on'=>'search'),
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
			//'id0' => array(self::BELONGS_TO, 'CrugeUser', 'id'),
			'identidad0' => array(self::BELONGS_TO, 'UsrEntidades', 'identidad'),
		);
	}
	
	
	public function getInfoUsuario($id)
	{
	    return Yii::app()->user->um->loadUserById($id,true);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'identidad' => 'Entidad',
			'telefono_particular' => 'Telf. Particular',
			'telefono_movil' => 'Telf. Movil',
			'estadoagente' => 'Estado',
		    'fecha_carga' => 'Fecha Carga',
		    'username' => 'Usuario',
		    'email' => 'Email',
		    'password' => 'Contraseña',
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
		$criteria->compare('telefono_particular',$this->telefono_particular,true);
		$criteria->compare('telefono_movil',$this->telefono_movil,true);
		$criteria->compare('estadoagente',$this->estadoagente);
		$criteria->compare('fecha_carga',$this->fecha_carga,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsrUsuariosAgentes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	public function getModelUsuarioCruge()
	{
	    return Yii::app()->user->um->loadUserById(Yii::app()->user->id);
	}
	
	
	public function getModeloUsuarioAgente()
	{
	    return UsrUsuariosAgentes::model()->findByPk(Yii::app()->user->id);
	}
}
