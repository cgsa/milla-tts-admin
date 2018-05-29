<?php

/**
 * This is the model class for table "imagenes".
 *
 * The followings are the available columns in table 'imagenes':
 * @property integer $id
 * @property string $path
 * @property string $thumb
 * @property string $crop
 * @property string $nombre
 * @property integer $es_banner
 *
 * The followings are the available model relations:
 * @property Banner[] $banners
 * @property GaleriaDestino[] $galeriaDestinos
 * @property ImagenesGalerias[] $imagenesGaleriases
 * @property Promociones[] $promociones
 */
class Imagenes extends CActiveRecord
{
    
    public $Filedata;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'imagenes';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('path', 'required'),
			array('es_banner', 'numerical', 'integerOnly'=>true),
			array('path, thumb, crop', 'length', 'max'=>100),
		    array('nombre', 'length', 'max'=>30),
		    array('Filedata', 'file', 'types'=>'jpg,jpeg,gif,png', 'safe' => false,'allowEmpty' => true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, path, thumb, crop, nombre, es_banner', 'safe', 'on'=>'search'),
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
			'banners' => array(self::HAS_MANY, 'Banner', 'id_imagen'),
			'galeriaDestinos' => array(self::HAS_MANY, 'GaleriaDestino', 'id_imagen'),
			'imagenesGaleriases' => array(self::HAS_MANY, 'ImagenesGalerias', 'id_imagen'),
			'promociones' => array(self::HAS_MANY, 'Promociones', 'id_imagen'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'path' => 'Path',
			'thumb' => 'Thumb',
			'crop' => 'Crop',
			'nombre' => 'Nombre',
			'es_banner' => 'Es Banner',
		);
	}
	
	
	public function createImageThumb( $file, $width )
	{
	    $uploadDir = Yii::app()->basePath .'/../upload/img';
	    //$file = $_GET["file"];
	    //$width = $_GET["width"];
	    
	    // Ponemos el . antes del nombre del archivo porque estamos considerando que la ruta está a partir del archivo thumb.php
	    $file_info = getimagesize( $uploadDir."/".$file);
	    // Obtenemos la relación de aspecto
	    $ratio = $file_info[0] / $file_info[1];
	    
	    // Calculamos las nuevas dimensiones
	    $newwidth = $width;
	    $newheight = round($newwidth / $ratio);
	    
	    // Sacamos la extensión del archivo
	    $ext = explode(".", $file);
	    $ext = strtolower($ext[count($ext) - 1]);
	    if ($ext == "jpeg") $ext = "jpg";
	    
	    // Dependiendo de la extensión llamamos a distintas funciones
	    switch ($ext) {
	        case "jpg":
	            $img = imagecreatefromjpeg($uploadDir."/". $file);
	            break;
	        case "png":
	            $img = imagecreatefrompng($uploadDir."/". $file);
	            break;
	        case "gif":
	            $img = imagecreatefromgif($uploadDir."/". $file);
	            break;
	    }
	    // Creamos la miniatura
	    $thumb = imagecreatetruecolor($newwidth, $newheight);
	    // La redimensionamos
	    imagecopyresampled($thumb, $img, 0, 0, 0, 0, $newwidth, $newheight, $file_info[0], $file_info[1]);
	    
	    
	    return $img;
	    
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
		$criteria->compare('path',$this->path,true);
		$criteria->compare('thumb',$this->thumb,true);
		$criteria->compare('crop',$this->crop,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('es_banner',$this->es_banner);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Imagenes the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
