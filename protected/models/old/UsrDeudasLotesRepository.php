<?php
class UsrDeudasLotesRepository
{
    
    public $modelo;
    
    private $conexion;
    
    private $comando;
    
    private $primeraLinea;
    
    
    
    public function __construct()
    {
        $this->modelo = new UsrDeudas;
        $this->conexion = Yii::app()->db;
    }
    
    
    public function registrarDeudas($oImport)
    {
        $this->getInsertDeudas();
        $lineas = $oImport->getLinesDoc();
        $campos = $this->getCamposBD();
        
        if($lineas !== null)
        {
            $this->setComando($this->getInsertDeudas());
            $campos = $this->getCamposBD();
            $tipoDatos = $this->getCampostipos();
            
            for($i=0; $i<count($lineas); $i++)
            {
                $array = array();
                $array = $oImport->lineToArray($lineas[$i]);
                //die("aquiiii: ".count($campos));
                $control = false;
                //var_dump($lineas[$i]);die; 
                if($i == 0)
                {
                    $this->primeraLinea = $array;
                }
                else
                {    
                    
                    foreach ($this->primeraLinea as $key=>$value)
                    {                        
                        if(isset($array[$key]))
                        {
                            $control = true;
                            $this->comando->bindValue($campos[$value], ValidaDatos::validar($tipoDatos[$value], $array[$key]) );
                        }                        
                    }
                    
                    if($control)
                    {
                        $oImport->procesados += 1; 
                        $this->comando->bindValue(":idusuario_carga", (int)Yii::app()->user->id );
                        $this->comando->bindValue(":idestadoregistro", 0);
                        $this->comando->bindValue(":fecha_carga",date("Y-m-d"));
                        $this->comando->execute();
                    }
                    
                    //CVarDumper::dump($this->comando, 4, true);
                    //Yii::app()->end();
                }
                
            }
        }
    }
    
    
    public function setComando($sql = null)
    {
        $this->comando = $this->conexion->createCommand($sql);	
    }
    
    
    private function getInsertDeudas()
    {
        $campos = implode(',', array_values($this->getCamposBD()));
        return "INSERT INTO db_cancelomideuda.usr_deudas ( ".str_replace(':', '', $campos ).",idusuario_carga,idestadoregistro,fecha_carga) VALUES (".$campos.",:idusuario_carga,:idestadoregistro,:fecha_carga);";
    }
    
    
    public function getCamposBD()
    {
        return array(
            'idcliente'=>':identificacion_unica_cliente', 'identidad'=>':identidad', 'nombrecliente'=>':nombre_cliente',
            'rfccliente'=>':rfc_cliente', 'clasificacion'=>':clasificacion_cliente', 'fechaatraso'=>':fecha_atraso', 'fechalote'=>':fecha_lote',
            'nroproducto'=>':nro_producto', 'descripciondeuda'=>':descripcion_deuda', 'deudatotal'=>':deuda_total',
            'ofertacuotas1'=>':oferta1_qcuotas','ofertamontocuota1'=>':oferta1_montocuota',
            'ofertavenc1'=>':oferta1_primer_vencimiento','ofertaporcentajequita1'=>':oferta1_porcentaje_quita',
            'ofertacuotas2'=>':oferta2_qcuotas','ofertamontocuota2'=>':oferta2_montocuota','ofertamontocuota2'=>':oferta2_montocuota',
            'ofertavenc2'=>':oferta2_primer_vencimiento','ofertaporcentajequita2'=>':oferta2_porcentaje_quita',
            'ofertacuotas3'=>':oferta3_qcuotas','ofertamontocuota3'=>':oferta3_montocuota','ofertamontocuota3'=>':oferta3_montocuota',
            'ofertavenc3'=>':oferta3_primer_vencimiento','ofertaporcentajequita3'=>':oferta3_porcentaje_quita',
            'ofertacuotas4'=>':oferta4_qcuotas','ofertamontocuota4'=>':oferta4_montocuota',
            'ofertavenc4'=>':oferta4_primer_vencimiento','ofertaporcentajequita4'=>':oferta4_porcentaje_quita',
            'ofertacuotas5'=>':oferta5_qcuotas','ofertamontocuota5'=>':oferta5_montocuota','ofertamontocuota5'=>':oferta5_montocuota',
            'ofertavenc5'=>':oferta5_primer_vencimiento','ofertaporcentajequita5'=>':oferta5_porcentaje_quita',
            'validacion1_pregunta'=>':validacion1_pregunta','validacion1_respuesta_valida'=>':validacion1_respuesta_valida',
            'validacion1_respuesta_erronea_1'=>':validacion1_respuesta_erronea_1','validacion1_respuesta_erronea_2'=>':validacion1_respuesta_erronea_2','validacion1_respuesta_erronea_3'=>':validacion1_respuesta_erronea_3',
            'validacion1_respuesta_erronea_4'=>':validacion1_respuesta_erronea_4','validacion2_pregunta'=>':validacion2_pregunta',
            'validacion2_respuesta_valida'=>':validacion2_respuesta_valida','validacion2_respuesta_erronea_1'=>':validacion2_respuesta_erronea_1',
            'validacion2_respuesta_erronea_2'=>':validacion2_respuesta_erronea_2',
            'validacion2_respuesta_erronea_3'=>':validacion2_respuesta_erronea_3','validacion2_respuesta_erronea_4'=>':validacion2_respuesta_erronea_4',
            'validacion3_pregunta'=>':validacion3_pregunta','validacion3_respuesta_valida'=>':validacion3_respuesta_valida',
            'validacion3_respuesta_erronea_1'=>':validacion3_respuesta_erronea_1','validacion3_respuesta_erronea_2'=>':validacion3_respuesta_erronea_2','validacion3_respuesta_erronea_3'=>':validacion3_respuesta_erronea_3',
            'validacion3_respuesta_erronea_4'=>':validacion3_respuesta_erronea_4',
            'validacion4_pregunta'=>':validacion4_pregunta','validacion4_respuesta_valida'=>':validacion4_respuesta_valida',
            'validacion4_respuesta_erronea_1'=>':validacion4_respuesta_erronea_1','validacion4_respuesta_erronea_2'=>':validacion4_respuesta_erronea_2','validacion4_respuesta_erronea_3'=>':validacion4_respuesta_erronea_3',
            'validacion4_respuesta_erronea_4'=>':validacion4_respuesta_erronea_4',
            'validacion5_pregunta'=>':validacion5_pregunta','validacion5_respuesta_valida'=>':validacion5_respuesta_valida',
            'validacion5_respuesta_erronea_1'=>':validacion5_respuesta_erronea_1','validacion5_respuesta_erronea_2'=>':validacion5_respuesta_erronea_2','validacion5_respuesta_erronea_3'=>':validacion5_respuesta_erronea_3',
            'validacion5_respuesta_erronea_4'=>':validacion5_respuesta_erronea_4',
            'adicional01'=>':adicional01','adicional02'=>':adicional02','adicional03'=>':adicional03','adicional04'=>':adicional04',
            'adicional05'=>':adicional05','adicional05'=>':adicional05');
    }
    
    
    public function getCampostipos()
    {
        return array(
            'idcliente'=>'INTEGER', 'identidad'=>'INTEGER', 'nombrecliente'=>'VARCHAR',
            'rfccliente'=>'VARCHAR', 'clasificacion'=>'VARCHAR', 'fechaatraso'=>'DATE', 'fechalote'=>'DATE',
            'nroproducto'=>'VARCHAR', 'descripciondeuda'=>'VARCHAR', 'deudatotal'=>'VARCHAR', 
            'ofertacuotas1'=>'INTEGER','ofertamontocuota1'=>'VARCHAR',
            'ofertavenc1'=>'DATE','ofertaporcentajequita1'=>'INTEGER',
            'ofertacuotas2'=>'INTEGER','ofertamontocuota2'=>'VARCHAR',
            'ofertavenc2'=>'DATE','ofertaporcentajequita2'=>'INTEGER',
            'ofertacuotas3'=>'INTEGER','ofertamontocuota3'=>'VARCHAR',
            'ofertavenc3'=>'DATE','ofertaporcentajequita3'=>'INTEGER',
            'ofertacuotas4'=>'INTEGER','ofertamontocuota4'=>'VARCHAR',
            'ofertavenc4'=>'DATE','ofertaporcentajequita4'=>'INTEGER',
            'ofertacuotas5'=>'INTEGER','ofertamontocuota5'=>'VARCHAR',
            'ofertavenc5'=>'DATE','ofertaporcentajequita5'=>'INTEGER',
            'validacion1_pregunta'=>'VARCHAR','validacion1_respuesta_valida'=>'VARCHAR',
            'validacion1_respuesta_erronea_1'=>'VARCHAR','validacion1_respuesta_erronea_2'=>'VARCHAR','validacion1_respuesta_erronea_3'=>'VARCHAR',
            'validacion1_respuesta_erronea_4'=>'VARCHAR','validacion2_pregunta'=>'VARCHAR',
            'validacion2_respuesta_valida'=>'VARCHAR','validacion2_respuesta_erronea_1'=>'VARCHAR','validacion2_respuesta_erronea_2'=>'VARCHAR',
            'validacion2_respuesta_erronea_3'=>'VARCHAR','validacion2_respuesta_erronea_4'=>'VARCHAR',
            'validacion3_pregunta'=>'VARCHAR','validacion3_respuesta_valida'=>'VARCHAR',
            'validacion3_respuesta_erronea_1'=>'VARCHAR','validacion3_respuesta_erronea_2'=>'VARCHAR','validacion3_respuesta_erronea_3'=>'VARCHAR',
            'validacion3_respuesta_erronea_4'=>'VARCHAR',
            'validacion4_pregunta'=>'VARCHAR','validacion4_respuesta_valida'=>'VARCHAR',
            'validacion4_respuesta_erronea_1'=>'VARCHAR','validacion4_respuesta_erronea_2'=>'VARCHAR','validacion4_respuesta_erronea_3'=>'VARCHAR',
            'validacion4_respuesta_erronea_4'=>'VARCHAR',
            'validacion5_pregunta'=>'VARCHAR','validacion5_respuesta_valida'=>'VARCHAR',
            'validacion5_respuesta_erronea_1'=>'VARCHAR','validacion5_respuesta_erronea_2'=>'VARCHAR','validacion5_respuesta_erronea_3'=>'VARCHAR',
            'validacion5_respuesta_erronea_4'=>'VARCHAR',
            'adicional01'=>'VARCHAR','adicional02'=>'VARCHAR','adicional03'=>'VARCHAR','adicional04'=>'VARCHAR',
            'adicional05'=>'VARCHAR','adicional05'=>'VARCHAR'
        );
    } 
    
    
    public function getDeudasActivas()
    {
        $criteria=new CDbCriteria;
        $criteria->condition = "idestadoregistro = 0";
        
        if(Yii::app()->user->checkAccess('USER-AGENTE') && Yii::app()->user->hasState('entidad'))
        {
            //die("aquiii".Yii::app()->user->checkAccess('USER-AGENTE'));
            $criteria->condition .= " AND identidad = ".Yii::app()->user->getState('entidad');
        }
        else if(Yii::app()->user->checkAccess('USER-SISTEMA'))
        {            
            $criteria->condition .= " AND rfc_cliente = '".Yii::app()->user->getState('rfc')."'";
        }
            
        
        return $this->modelo->findAll($criteria);
    }
    
    
    
    public function getDeudaDetalle($id)
    {
        if(is_numeric($id))
        {
            $criteria=new CDbCriteria;
            $criteria->condition = " id = ".$id;
            
            if(Yii::app()->user->checkAccess('USER-AGENTE') && Yii::app()->user->hasState('entidada'))
            {
                $criteria->condition .= " AND identidad = ".Yii::app()->user->getState('entidada');
            }
            else if(Yii::app()->user->checkAccess('USER-SISTEMA'))
            {
                $criteria->condition .= " AND rfc_cliente = '".Yii::app()->user->getState('rfc')."'";
            }
        
        
            return $this->modelo->find($criteria);
        }    
        
    }
    
    
    
    public function getInfoEntidad($id)
    {
        $model = new UsrEntidades;
        return $model->findByPk($id);
    }
    
    
}