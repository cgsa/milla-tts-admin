<?php

/**
 * This is the model class for table "configuracion".
 *
 * The followings are the available columns in table 'configuracion':
 * @property integer $id
 * @property string $cod_empresa
 * @property string $cod_subempresa
 * @property string $verificador
 * @property string $valor_millas
 */
class Configuracion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'configuracion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, cod_empresa, cod_subempresa, verificador, valor_millas', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('cod_empresa, cod_subempresa', 'length', 'max'=>15),
			array('verificador', 'length', 'max'=>2),
			array('valor_millas', 'length', 'max'=>8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, cod_empresa, cod_subempresa, verificador, valor_millas', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'cod_empresa' => 'Código Empresa',
			'cod_subempresa' => 'Código Sub Empresa',
			'verificador' => 'Verificador',
			'valor_millas' => 'Valor Millas',
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
		$criteria->compare('cod_empresa',$this->cod_empresa,true);
		$criteria->compare('cod_subempresa',$this->cod_subempresa,true);
		$criteria->compare('verificador',$this->verificador,true);
		$criteria->compare('valor_millas',$this->valor_millas,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Configuracion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
