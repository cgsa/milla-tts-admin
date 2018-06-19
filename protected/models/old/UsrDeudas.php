<?php

/**
 * This is the model class for table "usr_deudas".
 *
 * The followings are the available columns in table 'usr_deudas':
 * @property integer $id
 * @property string $identificacion_unica_cliente
 * @property integer $identidad
 * @property string $nombre_cliente
 * @property string $rfc_cliente
 * @property string $clasificacion_cliente
 * @property string $fecha_atraso
 * @property string $fecha_lote
 * @property string $nro_producto
 * @property string $descripcion_deuda
 * @property string $deuda_total
 * @property integer $oferta1_qcuotas
 * @property string $oferta1_montocuota
 * @property string $oferta1_primer_vencimiento
 * @property integer $oferta1_porcentaje_quita
 * @property integer $oferta2_qcuotas
 * @property string $oferta2_montocuota
 * @property string $oferta2_primer_vencimiento
 * @property integer $oferta2_porcentaje_quita
 * @property integer $oferta3_qcuotas
 * @property string $oferta3_montocuota
 * @property string $oferta3_primer_vencimiento
 * @property integer $oferta3_porcentaje_quita
 * @property integer $oferta4_qcuotas
 * @property string $oferta4_montocuota
 * @property string $oferta4_primer_vencimiento
 * @property integer $oferta4_porcentaje_quita
 * @property integer $oferta5_qcuotas
 * @property string $oferta5_montocuota
 * @property string $oferta5_primer_vencimiento
 * @property integer $oferta5_porcentaje_quita
 * @property string $validacion1_pregunta
 * @property string $validacion1_respuesta_valida
 * @property string $validacion1_respuesta_erronea_1
 * @property string $validacion1_respuesta_erronea_2
 * @property string $validacion1_respuesta_erronea_3
 * @property string $validacion1_respuesta_erronea_4
 * @property string $validacion2_pregunta
 * @property string $validacion2_respuesta_valida
 * @property string $validacion2_respuesta_erronea_1
 * @property string $validacion2_respuesta_erronea_2
 * @property string $validacion2_respuesta_erronea_3
 * @property string $validacion2_respuesta_erronea_4
 * @property string $validacion3_pregunta
 * @property string $validacion3_respuesta_valida
 * @property string $validacion3_respuesta_erronea_1
 * @property string $validacion3_respuesta_erronea_2
 * @property string $validacion3_respuesta_erronea_3
 * @property string $validacion3_respuesta_erronea_4
 * @property string $validacion4_pregunta
 * @property string $validacion4_respuesta_valida
 * @property string $validacion4_respuesta_erronea_1
 * @property string $validacion4_respuesta_erronea_2
 * @property string $validacion4_respuesta_erronea_3
 * @property string $validacion4_respuesta_erronea_4
 * @property string $validacion5_pregunta
 * @property string $validacion5_respuesta_valida
 * @property string $validacion5_respuesta_erronea_1
 * @property string $validacion5_respuesta_erronea_2
 * @property string $validacion5_respuesta_erronea_3
 * @property string $validacion5_respuesta_erronea_4
 * @property string $adicional01
 * @property string $adicional02
 * @property string $adicional03
 * @property string $adicional04
 * @property string $adicional05
 * @property string $fecha_carga
 * @property integer $idusuario_carga
 * @property integer $idestadoregistro
 */
class UsrDeudas extends CActiveRecord
{
    
    public $filename;
    
    
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usr_deudas';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id', 'required'),
			array('id, identidad, oferta1_qcuotas, oferta1_porcentaje_quita, oferta2_qcuotas, oferta2_porcentaje_quita, oferta3_qcuotas, oferta3_porcentaje_quita, oferta4_qcuotas, oferta4_porcentaje_quita, oferta5_qcuotas, oferta5_porcentaje_quita, idusuario_carga, idestadoregistro', 'numerical', 'integerOnly'=>true),
		    array('identificacion_unica_cliente', 'length', 'max'=>22),
		    array('filename', 'file', 'types'=>'xls', 'safe' => false,'allowEmpty' => true),
			array('nombre_cliente, rfc_cliente, clasificacion_cliente, nro_producto, descripcion_deuda, validacion1_pregunta, validacion2_pregunta, validacion3_pregunta, validacion4_pregunta, validacion5_pregunta', 'length', 'max'=>50),
			array('deuda_total, oferta1_montocuota, oferta2_montocuota, oferta3_montocuota, oferta4_montocuota, oferta5_montocuota', 'length', 'max'=>11),
			array('validacion1_respuesta_valida, validacion1_respuesta_erronea_1, validacion1_respuesta_erronea_2, validacion1_respuesta_erronea_3, validacion1_respuesta_erronea_4, validacion2_respuesta_valida, validacion2_respuesta_erronea_1, validacion2_respuesta_erronea_2, validacion2_respuesta_erronea_3, validacion2_respuesta_erronea_4, validacion3_respuesta_valida, validacion3_respuesta_erronea_1, validacion3_respuesta_erronea_2, validacion3_respuesta_erronea_3, validacion3_respuesta_erronea_4, validacion4_respuesta_valida, validacion4_respuesta_erronea_1, validacion4_respuesta_erronea_2, validacion4_respuesta_erronea_3, validacion4_respuesta_erronea_4, validacion5_respuesta_valida, validacion5_respuesta_erronea_1, validacion5_respuesta_erronea_2, validacion5_respuesta_erronea_3, validacion5_respuesta_erronea_4, adicional01, adicional02, adicional03, adicional04, adicional05', 'length', 'max'=>30),
			array('fecha_atraso, fecha_lote, oferta1_primer_vencimiento, oferta2_primer_vencimiento, oferta3_primer_vencimiento, oferta4_primer_vencimiento, oferta5_primer_vencimiento, fecha_carga', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, identificacion_unica_cliente, identidad, nombre_cliente, rfc_cliente, clasificacion_cliente, fecha_atraso, fecha_lote, nro_producto, descripcion_deuda, deuda_total, oferta1_qcuotas, oferta1_montocuota, oferta1_primer_vencimiento, oferta1_porcentaje_quita, oferta2_qcuotas, oferta2_montocuota, oferta2_primer_vencimiento, oferta2_porcentaje_quita, oferta3_qcuotas, oferta3_montocuota, oferta3_primer_vencimiento, oferta3_porcentaje_quita, oferta4_qcuotas, oferta4_montocuota, oferta4_primer_vencimiento, oferta4_porcentaje_quita, oferta5_qcuotas, oferta5_montocuota, oferta5_primer_vencimiento, oferta5_porcentaje_quita, validacion1_pregunta, validacion1_respuesta_valida, validacion1_respuesta_erronea_1, validacion1_respuesta_erronea_2, validacion1_respuesta_erronea_3, validacion1_respuesta_erronea_4, validacion2_pregunta, validacion2_respuesta_valida, validacion2_respuesta_erronea_1, validacion2_respuesta_erronea_2, validacion2_respuesta_erronea_3, validacion2_respuesta_erronea_4, validacion3_pregunta, validacion3_respuesta_valida, validacion3_respuesta_erronea_1, validacion3_respuesta_erronea_2, validacion3_respuesta_erronea_3, validacion3_respuesta_erronea_4, validacion4_pregunta, validacion4_respuesta_valida, validacion4_respuesta_erronea_1, validacion4_respuesta_erronea_2, validacion4_respuesta_erronea_3, validacion4_respuesta_erronea_4, validacion5_pregunta, validacion5_respuesta_valida, validacion5_respuesta_erronea_1, validacion5_respuesta_erronea_2, validacion5_respuesta_erronea_3, validacion5_respuesta_erronea_4, adicional01, adicional02, adicional03, adicional04, adicional05, fecha_carga, idusuario_carga, idestadoregistro', 'safe', 'on'=>'search'),
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
			'identificacion_unica_cliente' => 'Identificacion Unica Cliente',
			'identidad' => 'Identidad',
			'nombre_cliente' => 'Nombre Cliente',
			'rfc_cliente' => 'Rfc Cliente',
			'clasificacion_cliente' => 'Clasificacion Cliente',
			'fecha_atraso' => 'Fecha Atraso',
			'fecha_lote' => 'Fecha Lote',
			'nro_producto' => 'Nro Producto',
			'descripcion_deuda' => 'Descripcion Deuda',
			'deuda_total' => 'Deuda Total',
			'oferta1_qcuotas' => 'Oferta1 Qcuotas',
			'oferta1_montocuota' => 'Oferta1 Montocuota',
			'oferta1_primer_vencimiento' => 'Oferta1 Primer Vencimiento',
			'oferta1_porcentaje_quita' => 'Oferta1 Porcentaje Quita',
			'oferta2_qcuotas' => 'Oferta2 Qcuotas',
			'oferta2_montocuota' => 'Oferta2 Montocuota',
			'oferta2_primer_vencimiento' => 'Oferta2 Primer Vencimiento',
			'oferta2_porcentaje_quita' => 'Oferta2 Porcentaje Quita',
			'oferta3_qcuotas' => 'Oferta3 Qcuotas',
			'oferta3_montocuota' => 'Oferta3 Montocuota',
			'oferta3_primer_vencimiento' => 'Oferta3 Primer Vencimiento',
			'oferta3_porcentaje_quita' => 'Oferta3 Porcentaje Quita',
			'oferta4_qcuotas' => 'Oferta4 Qcuotas',
			'oferta4_montocuota' => 'Oferta4 Montocuota',
			'oferta4_primer_vencimiento' => 'Oferta4 Primer Vencimiento',
			'oferta4_porcentaje_quita' => 'Oferta4 Porcentaje Quita',
			'oferta5_qcuotas' => 'Oferta5 Qcuotas',
			'oferta5_montocuota' => 'Oferta5 Montocuota',
			'oferta5_primer_vencimiento' => 'Oferta5 Primer Vencimiento',
			'oferta5_porcentaje_quita' => 'Oferta5 Porcentaje Quita',
			'validacion1_pregunta' => 'Validacion1 Pregunta',
			'validacion1_respuesta_valida' => 'Validacion1 Respuesta Valida',
			'validacion1_respuesta_erronea_1' => 'Validacion1 Respuesta Erronea 1',
			'validacion1_respuesta_erronea_2' => 'Validacion1 Respuesta Erronea 2',
			'validacion1_respuesta_erronea_3' => 'Validacion1 Respuesta Erronea 3',
			'validacion1_respuesta_erronea_4' => 'Validacion1 Respuesta Erronea 4',
			'validacion2_pregunta' => 'Validacion2 Pregunta',
			'validacion2_respuesta_valida' => 'Validacion2 Respuesta Valida',
			'validacion2_respuesta_erronea_1' => 'Validacion2 Respuesta Erronea 1',
			'validacion2_respuesta_erronea_2' => 'Validacion2 Respuesta Erronea 2',
			'validacion2_respuesta_erronea_3' => 'Validacion2 Respuesta Erronea 3',
			'validacion2_respuesta_erronea_4' => 'Validacion2 Respuesta Erronea 4',
			'validacion3_pregunta' => 'Validacion3 Pregunta',
			'validacion3_respuesta_valida' => 'Validacion3 Respuesta Valida',
			'validacion3_respuesta_erronea_1' => 'Validacion3 Respuesta Erronea 1',
			'validacion3_respuesta_erronea_2' => 'Validacion3 Respuesta Erronea 2',
			'validacion3_respuesta_erronea_3' => 'Validacion3 Respuesta Erronea 3',
			'validacion3_respuesta_erronea_4' => 'Validacion3 Respuesta Erronea 4',
			'validacion4_pregunta' => 'Validacion4 Pregunta',
			'validacion4_respuesta_valida' => 'Validacion4 Respuesta Valida',
			'validacion4_respuesta_erronea_1' => 'Validacion4 Respuesta Erronea 1',
			'validacion4_respuesta_erronea_2' => 'Validacion4 Respuesta Erronea 2',
			'validacion4_respuesta_erronea_3' => 'Validacion4 Respuesta Erronea 3',
			'validacion4_respuesta_erronea_4' => 'Validacion4 Respuesta Erronea 4',
			'validacion5_pregunta' => 'Validacion5 Pregunta',
			'validacion5_respuesta_valida' => 'Validacion5 Respuesta Valida',
			'validacion5_respuesta_erronea_1' => 'Validacion5 Respuesta Erronea 1',
			'validacion5_respuesta_erronea_2' => 'Validacion5 Respuesta Erronea 2',
			'validacion5_respuesta_erronea_3' => 'Validacion5 Respuesta Erronea 3',
			'validacion5_respuesta_erronea_4' => 'Validacion5 Respuesta Erronea 4',
			'adicional01' => 'Adicional01',
			'adicional02' => 'Adicional02',
			'adicional03' => 'Adicional03',
			'adicional04' => 'Adicional04',
			'adicional05' => 'Adicional05',
			'fecha_carga' => 'Fecha Carga',
			'idusuario_carga' => 'Idusuario Carga',
			'idestadoregistro' => 'Idestadoregistro',
		    'filename' =>'Archivo',
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
		$criteria->compare('identificacion_unica_cliente',$this->identificacion_unica_cliente,true);
		$criteria->compare('identidad',$this->identidad);
		$criteria->compare('nombre_cliente',$this->nombre_cliente,true);
		$criteria->compare('rfc_cliente',$this->rfc_cliente,true);
		$criteria->compare('clasificacion_cliente',$this->clasificacion_cliente,true);
		$criteria->compare('fecha_atraso',$this->fecha_atraso,true);
		$criteria->compare('fecha_lote',$this->fecha_lote,true);
		$criteria->compare('nro_producto',$this->nro_producto,true);
		$criteria->compare('descripcion_deuda',$this->descripcion_deuda,true);
		$criteria->compare('deuda_total',$this->deuda_total,true);
		$criteria->compare('oferta1_qcuotas',$this->oferta1_qcuotas);
		$criteria->compare('oferta1_montocuota',$this->oferta1_montocuota,true);
		$criteria->compare('oferta1_primer_vencimiento',$this->oferta1_primer_vencimiento,true);
		$criteria->compare('oferta1_porcentaje_quita',$this->oferta1_porcentaje_quita);
		$criteria->compare('oferta2_qcuotas',$this->oferta2_qcuotas);
		$criteria->compare('oferta2_montocuota',$this->oferta2_montocuota,true);
		$criteria->compare('oferta2_primer_vencimiento',$this->oferta2_primer_vencimiento,true);
		$criteria->compare('oferta2_porcentaje_quita',$this->oferta2_porcentaje_quita);
		$criteria->compare('oferta3_qcuotas',$this->oferta3_qcuotas);
		$criteria->compare('oferta3_montocuota',$this->oferta3_montocuota,true);
		$criteria->compare('oferta3_primer_vencimiento',$this->oferta3_primer_vencimiento,true);
		$criteria->compare('oferta3_porcentaje_quita',$this->oferta3_porcentaje_quita);
		$criteria->compare('oferta4_qcuotas',$this->oferta4_qcuotas);
		$criteria->compare('oferta4_montocuota',$this->oferta4_montocuota,true);
		$criteria->compare('oferta4_primer_vencimiento',$this->oferta4_primer_vencimiento,true);
		$criteria->compare('oferta4_porcentaje_quita',$this->oferta4_porcentaje_quita);
		$criteria->compare('oferta5_qcuotas',$this->oferta5_qcuotas);
		$criteria->compare('oferta5_montocuota',$this->oferta5_montocuota,true);
		$criteria->compare('oferta5_primer_vencimiento',$this->oferta5_primer_vencimiento,true);
		$criteria->compare('oferta5_porcentaje_quita',$this->oferta5_porcentaje_quita);
		$criteria->compare('validacion1_pregunta',$this->validacion1_pregunta,true);
		$criteria->compare('validacion1_respuesta_valida',$this->validacion1_respuesta_valida,true);
		$criteria->compare('validacion1_respuesta_erronea_1',$this->validacion1_respuesta_erronea_1,true);
		$criteria->compare('validacion1_respuesta_erronea_2',$this->validacion1_respuesta_erronea_2,true);
		$criteria->compare('validacion1_respuesta_erronea_3',$this->validacion1_respuesta_erronea_3,true);
		$criteria->compare('validacion1_respuesta_erronea_4',$this->validacion1_respuesta_erronea_4,true);
		$criteria->compare('validacion2_pregunta',$this->validacion2_pregunta,true);
		$criteria->compare('validacion2_respuesta_valida',$this->validacion2_respuesta_valida,true);
		$criteria->compare('validacion2_respuesta_erronea_1',$this->validacion2_respuesta_erronea_1,true);
		$criteria->compare('validacion2_respuesta_erronea_2',$this->validacion2_respuesta_erronea_2,true);
		$criteria->compare('validacion2_respuesta_erronea_3',$this->validacion2_respuesta_erronea_3,true);
		$criteria->compare('validacion2_respuesta_erronea_4',$this->validacion2_respuesta_erronea_4,true);
		$criteria->compare('validacion3_pregunta',$this->validacion3_pregunta,true);
		$criteria->compare('validacion3_respuesta_valida',$this->validacion3_respuesta_valida,true);
		$criteria->compare('validacion3_respuesta_erronea_1',$this->validacion3_respuesta_erronea_1,true);
		$criteria->compare('validacion3_respuesta_erronea_2',$this->validacion3_respuesta_erronea_2,true);
		$criteria->compare('validacion3_respuesta_erronea_3',$this->validacion3_respuesta_erronea_3,true);
		$criteria->compare('validacion3_respuesta_erronea_4',$this->validacion3_respuesta_erronea_4,true);
		$criteria->compare('validacion4_pregunta',$this->validacion4_pregunta,true);
		$criteria->compare('validacion4_respuesta_valida',$this->validacion4_respuesta_valida,true);
		$criteria->compare('validacion4_respuesta_erronea_1',$this->validacion4_respuesta_erronea_1,true);
		$criteria->compare('validacion4_respuesta_erronea_2',$this->validacion4_respuesta_erronea_2,true);
		$criteria->compare('validacion4_respuesta_erronea_3',$this->validacion4_respuesta_erronea_3,true);
		$criteria->compare('validacion4_respuesta_erronea_4',$this->validacion4_respuesta_erronea_4,true);
		$criteria->compare('validacion5_pregunta',$this->validacion5_pregunta,true);
		$criteria->compare('validacion5_respuesta_valida',$this->validacion5_respuesta_valida,true);
		$criteria->compare('validacion5_respuesta_erronea_1',$this->validacion5_respuesta_erronea_1,true);
		$criteria->compare('validacion5_respuesta_erronea_2',$this->validacion5_respuesta_erronea_2,true);
		$criteria->compare('validacion5_respuesta_erronea_3',$this->validacion5_respuesta_erronea_3,true);
		$criteria->compare('validacion5_respuesta_erronea_4',$this->validacion5_respuesta_erronea_4,true);
		$criteria->compare('adicional01',$this->adicional01,true);
		$criteria->compare('adicional02',$this->adicional02,true);
		$criteria->compare('adicional03',$this->adicional03,true);
		$criteria->compare('adicional04',$this->adicional04,true);
		$criteria->compare('adicional05',$this->adicional05,true);
		$criteria->compare('fecha_carga',$this->fecha_carga,true);
		$criteria->compare('idusuario_carga',$this->idusuario_carga);
		$criteria->compare('idestadoregistro',$this->idestadoregistro);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UsrDeudas the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
