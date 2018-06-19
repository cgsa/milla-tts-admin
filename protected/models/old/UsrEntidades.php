<?php

/**
 * This is the model class for table "usr_entidades".
 *
 * The followings are the available columns in table 'usr_entidades':
 * @property integer $id
 * @property string $nombre_entidad
 * @property string $logo
 * @property string $codigo_url
 * @property integer $idestadoentidad
 * @property string $fecha_carga
 * @property string $codapi
 *
 * The followings are the available model relations:
 * @property EtiquetasCamposAdicionales[] $etiquetasCamposAdicionales
 * @property HerramientasEntidad[] $herramientasEntidads
 * @property UsrMensajes[] $usrMensajes
 * @property UsrUsuariosAgentes[] $usrUsuariosAgentes
 */
class UsrEntidades extends CActiveRecord
{
    
    public $filename;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usr_entidades';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idestadoentidad', 'numerical', 'integerOnly'=>true),
		    array('nombre_entidad', 'length', 'max'=>50),
		    array('nombre_entidad,codapi', 'unique'),
		    array('logo', 'length', 'max'=>100),
		    array('filename', 'file', 'types'=>'png,jpg,jpeg', 'safe' => false,'allowEmpty' => true),
			array('codigo_url', 'length', 'max'=>15),
			array('codapi', 'length', 'max'=>10),
			array('fecha_carga', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, nombre_entidad, logo, codigo_url, idestadoentidad, fecha_carga, codapi', 'safe', 'on'=>'search'),
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
			'etiquetasCamposAdicionales' => array(self::HAS_MANY, 'EtiquetasCamposAdicionales', 'identidad'),
			'herramientasEntidads' => array(self::HAS_MANY, 'HerramientasEntidad', 'identidad'),
			'usrMensajes' => array(self::HAS_MANY, 'UsrMensajes', 'identidad'),
			'usrUsuariosAgentes' => array(self::HAS_MANY, 'UsrUsuariosAgentes', 'identidad'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'nombre_entidad' => 'Nombre Entidad',
			'logo' => 'Logo',
			'codigo_url' => 'Codigo Url',
			'idestadoentidad' => 'Idestadoentidad',
			'fecha_carga' => 'Fecha Carga',
		    'codapi' => 'Código Api',
		    'filename'=>'Logo'
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
		$criteria->compare('nombre_entidad',$this->nombre_entidad,true);
		$criteria->compare('logo',$this->logo,true);
		$criteria->compare('codigo_url',$this->codigo_url,true);
		$criteria->compare('idestadoentidad',$this->idestadoentidad);
		$criteria->compare('fecha_carga',$this->fecha_carga,true);
		$criteria->compare('codapi',$this->codapi,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsrEntidades the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
