<?php

/**
 * This is the model class for table "herramientas".
 *
 * The followings are the available columns in table 'herramientas':
 * @property integer $id
 * @property string $nombre
 * @property string $codigo
 * @property string $logo
 * @property integer $idestadoherramienta
 * @property string $json_config
 *
 * The followings are the available model relations:
 * @property HerramientasEntidad[] $herramientasEntidads
 * @property Planes[] $planes
 */
class Herramientas extends CActiveRecord
{
    
    /**
     * $propiedad que se usa para la carga del logo de entidades
     * */
    public $filename;
    
    
    public $json_config;
    
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'herramientas';
    }
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('nombre', 'required'),
            array('idestadoherramienta', 'numerical', 'integerOnly'=>true),
            array('nombre, logo', 'length', 'max'=>100),
            array('filename', 'file', 'types'=>'png,jpg,jpeg', 'safe' => false,'allowEmpty' => true),
            array('codigo', 'length', 'max'=>6),
            array('json_config', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, nombre, codigo, logo, idestadoherramienta,json_config', 'safe', 'on'=>'search'),
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
            'herramientasEntidads' => array(self::HAS_MANY, 'HerramientasEntidad', 'idherramienta'),
            'planes' => array(self::HAS_MANY, 'Planes', 'idherramienta'),
        );
    }
    
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'nombre' => 'Nombre',
            'codigo' => 'Código',
            'logo' => 'Logo',
            'idestadoherramienta' => 'Estado',
            'json_config' => 'Campos Json',
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
        $criteria->compare('nombre',$this->nombre,true);
        $criteria->compare('codigo',$this->codigo,true);
        $criteria->compare('logo',$this->logo,true);
        $criteria->compare('idestadoherramienta',$this->idestadoherramienta);
        $criteria->compare('json_config',$this->json_config,true);
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Herramientas the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
