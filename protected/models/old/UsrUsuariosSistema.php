<?php
/**
 * This is the model class for table "usr_usuarios_sistema".
 *
 * The followings are the available columns in table 'usr_usuarios_sistema':
 * @property integer $id
 * @property integer $id_user
 * @property string $rfc
 * @property string $nombre
 * @property string $apellido
 * @property string $fecha_nacimiento
 * @property string $mail
 * @property string $telefono_particular
 * @property string $telefono_movil
 * @property string $domicilio_particular_calle
 * @property string $domicilio_particular_numero_exterior
 * @property string $domicilio_particular_numero_interior
 * @property string $domicilio_particular_cp
 * @property string $domicilio_particular_colonia
 * @property string $domicilio_particular_poblacion
 * @property string $domicilio_particular_estado
 * @property integer $check_notifications
 * @property string $usuario
 * @property string $pass
 * @property integer $estadousuario
 * @property string $fecha_carga
 * @property integer $validar_pregunta
 */
class UsrUsuariosSistema extends CActiveRecord
{
    
    public $pass2;
    
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usr_usuarios_sistema';
	}
	
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
	    // NOTE: you should only define rules for those attributes that
	    // will receive user inputs.
	    return array(
	        array('id_user, check_notifications,validar_pregunta, estadousuario', 'numerical', 'integerOnly'=>true),
	        array('rfc, nombre, apellido, telefono_particular, telefono_movil, domicilio_particular_calle', 'length', 'max'=>50),
	        array('rfc, nombre, apellido, mail, fecha_nacimiento,usuario,pass', 'required','on'=>'insert'),
	        array('mail','email'),
	        array('domicilio_particular_numero_exterior, domicilio_particular_numero_interior, domicilio_particular_cp', 'length', 'max'=>10),
	        array('domicilio_particular_colonia, domicilio_particular_poblacion, domicilio_particular_estado', 'length', 'max'=>30),
	        array('usuario,mail', 'length', 'max'=>100),
	        array('pass', 'length', 'max'=>150),
	        array('pass2', 'compare', 'compareAttribute'=>'pass', 'operator'=>'=', 'message'=>'Las contraseñas deben coincidir'),
	        array('fecha_nacimiento, fecha_carga', 'safe'),
	        // The following rule is used by search().
	        // @todo Please remove those attributes that should not be searched.
	        array('id, id_user, rfc, nombre, apellido, fecha_nacimiento, mail, telefono_particular, telefono_movil, domicilio_particular_calle, domicilio_particular_numero_exterior, domicilio_particular_numero_interior, domicilio_particular_cp, domicilio_particular_colonia, domicilio_particular_poblacion, domicilio_particular_estado, check_notifications, usuario, pass, estadousuario, fecha_carga, validar_pregunta', 'safe', 'on'=>'search'),
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
	        'id' => 'Id',
	        'id_user' => 'User Sistema',
	        'rfc' => 'RFC',
	        'nombre' => 'Nombre',
	        'apellido' => 'Apellido',
	        'fecha_nacimiento' => 'Fecha Nacimiento',
	        'mail' => 'Email',
	        'telefono_particular' => 'Teléfono Particular',
	        'telefono_movil' => 'Teléfono Movil',
	        'domicilio_particular_calle' => 'Calle',
	        'domicilio_particular_numero_exterior' => 'Numero Exterior',
	        'domicilio_particular_numero_interior' => 'Numero Interior',
	        'domicilio_particular_cp' => 'Codigo Postal',
	        'domicilio_particular_colonia' => 'Colonia',
	        'domicilio_particular_poblacion' => 'Población',
	        'domicilio_particular_estado' => 'Estado',
	        'check_notifications' => 'Check Notifications',
	        'usuario' => 'Usuario',
	        'pass' => 'Contraseña',
	        'pass2' => 'Repetir Contraseña',
	        'estadousuario' => 'Estadousuario',
	        'fecha_carga' => 'Fecha Carga',
			'validar_pregunta' => 'Validar Pregunta',
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
		$criteria->compare('rfc',$this->rfc,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('fecha_nacimiento',$this->fecha_nacimiento,true);
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('telefono_particular',$this->telefono_particular,true);
		$criteria->compare('telefono_movil',$this->telefono_movil,true);
		$criteria->compare('domicilio_particular_calle',$this->domicilio_particular_calle,true);
		$criteria->compare('domicilio_particular_numero_exterior',$this->domicilio_particular_numero_exterior,true);
		$criteria->compare('domicilio_particular_numero_interior',$this->domicilio_particular_numero_interior,true);
		$criteria->compare('domicilio_particular_cp',$this->domicilio_particular_cp,true);
		$criteria->compare('domicilio_particular_colonia',$this->domicilio_particular_colonia,true);
		$criteria->compare('domicilio_particular_poblacion',$this->domicilio_particular_poblacion,true);
		$criteria->compare('domicilio_particular_estado',$this->domicilio_particular_estado,true);
		$criteria->compare('check_notifications',$this->check_notifications);
		$criteria->compare('usuario',$this->usuario,true);
		$criteria->compare('pass',$this->pass,true);
		$criteria->compare('estadousuario',$this->estadousuario);
		$criteria->compare('fecha_carga',$this->fecha_carga,true);
		$criteria->compare('validar_pregunta',$this->validar_pregunta);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsrUsuariosSistema the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
