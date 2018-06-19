<?php

/**
 * This is the model class for table "usuario_sistema".
 *
 * The followings are the available columns in table 'usuario_sistema':
 * @property integer $id
 * @property integer $id_user
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string $password
 * @property string $telefono
 * @property string $fecha_registro
 * @property integer $estadousuario
 *
 * The followings are the available model relations:
 * @property CrugeUser $idUser
 */
class UsuarioSistema extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario_sistema';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, apellido, email, password, telefono', 'required'),
			array('id_user, estadousuario', 'numerical', 'integerOnly'=>true),
			array('nombre, apellido', 'length', 'max'=>60),
			array('email', 'length', 'max'=>100),
			array('password', 'length', 'max'=>150),
			array('telefono', 'length', 'max'=>16),
			array('fecha_registro', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_user, nombre, apellido, email, password, telefono, fecha_registro, estadousuario', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_user' => 'Id User',
			'nombre' => 'Nombre',
			'apellido' => 'Apellido',
			'email' => 'Email',
			'password' => 'Password',
			'telefono' => 'Telefono',
			'fecha_registro' => 'Fecha Registro',
			'estadousuario' => 'Estadousuario',
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
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('telefono',$this->telefono,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		$criteria->compare('estadousuario',$this->estadousuario);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsuarioSistema the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
