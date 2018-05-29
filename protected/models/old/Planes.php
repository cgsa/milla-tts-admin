<?php

/**
 * This is the model class for table "planes".
 *
 * The followings are the available columns in table 'planes':
 * @property integer $id
 * @property integer $idherramienta
 * @property integer $idestadoplan
 * @property string $nombre
 * @property string $descripcion
 * @property string $costo
 * @property string $imagen
 * @property string $fecha_registro
 * @property integer $idopcionpago
 * @property string $fecha_desactivar
 *
 * The followings are the available model relations:
 * @property Herramientas $idherramienta0
 * @property UsrPlanesEntidad[] $usrPlanesEntidads
 */
class Planes extends CActiveRecord
{
    
    public $planactivo;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'planes';
    }
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('idherramienta, nombre', 'required'),
            array('idherramienta, idestadoplan, idopcionpago', 'numerical', 'integerOnly'=>true),
            array('nombre, imagen', 'length', 'max'=>100),
            array('costo', 'length', 'max'=>20),
            array('idestadoplan', 'default','value'=> 1,'on'=>'insert'),
            array('costo', 'default','value'=> 0,'on'=>'insert'),
            array('fecha_registro', 'default','value'=>new CDbExpression('NOW()'),'on'=>'insert'),
            array('descripcion, fecha_registro, fecha_desactivar', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, idherramienta, idestadoplan, nombre, descripcion, costo, imagen, fecha_registro, idopcionpago, fecha_desactivar', 'safe', 'on'=>'search'),
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
            'idherramienta0' => array(self::BELONGS_TO, 'Herramientas', 'idherramienta'),
            'usrPlanesEntidads' => array(self::HAS_MANY, 'UsrPlanesEntidad', 'idplan'),
        );
    }
    
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'idherramienta' => 'Herramienta',
            'idestadoplan' => 'Estado',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'costo' => 'Costo',
            'imagen' => 'Imagen',
            'fecha_registro' => 'Fecha Registro',
            'idopcionpago' => 'Opción de Pago',
            'fecha_desactivar' => 'Fecha Desactivar',
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
        $criteria->compare('idherramienta',$this->idherramienta);
        $criteria->compare('idestadoplan',$this->idestadoplan);
        $criteria->compare('nombre',$this->nombre,true);
        $criteria->compare('descripcion',$this->descripcion,true);
        $criteria->compare('costo',$this->costo,true);
        $criteria->compare('imagen',$this->imagen,true);
        $criteria->compare('fecha_registro',$this->fecha_registro,true);
        $criteria->compare('idopcionpago',$this->idopcionpago);
        $criteria->compare('fecha_desactivar',$this->fecha_desactivar,true);
        
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
    
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Planes the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
}
