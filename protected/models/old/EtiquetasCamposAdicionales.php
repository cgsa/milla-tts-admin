<?php

/**
 * This is the model class for table "etiquetas_campos_adicionales".
 *
 * The followings are the available columns in table 'etiquetas_campos_adicionales':
 * @property integer $id
 * @property string $adicional01
 * @property string $adicional02
 * @property string $adicional03
 * @property string $adicional04
 * @property string $adicional05
 * @property integer $identidad
 *
 * The followings are the available model relations:
 * @property UsrEntidades $identidad0
 */
class EtiquetasCamposAdicionales extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'etiquetas_campos_adicionales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('identidad', 'required'),
			array('identidad', 'numerical', 'integerOnly'=>true),
			array('adicional01, adicional02, adicional03, adicional05', 'length', 'max'=>50),
			array('adicional04', 'length', 'max'=>54),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, adicional01, adicional02, adicional03, adicional04, adicional05, identidad', 'safe', 'on'=>'search'),
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
			'adicional01' => 'Campo adicional 1',
			'adicional02' => 'Campo adicional 2',
			'adicional03' => 'Campo adicional 3',
			'adicional04' => 'Campo adicional 4',
			'adicional05' => 'Campo adicional 5',
			'identidad' => 'Identidad',
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
		$criteria->compare('adicional01',$this->adicional01,true);
		$criteria->compare('adicional02',$this->adicional02,true);
		$criteria->compare('adicional03',$this->adicional03,true);
		$criteria->compare('adicional04',$this->adicional04,true);
		$criteria->compare('adicional05',$this->adicional05,true);
		$criteria->compare('identidad',$this->identidad);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EtiquetasCamposAdicionales the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	
	public function getEtiquetas()
	{
	    
	    $criteria=new CDbCriteria;
	    $criteria->condition = "identidad = ".(int)Yii::app()->user->getState('entidad');
	    $model = $this->find($criteria);
	    
	    if(is_null($model))
	    {
	        $model = $this->iniciarEtiquetas();
	        
	    }
	    
	    return $model;
	}
	
	
	private function iniciarEtiquetas()
	{
	    $this->identidad = (int)Yii::app()->user->getState('entidad');
	    $this->save(); 
	    
	    return $this;
	}
	
	
}
