<?php
class OpcionesPagoRepository
{
    
    public $modelo;
    
    private $conexion;
    
    private $comando;
    
    private $primeraLinea;
    
    
    
    public function __construct()
    {
        $this->modelo = new OpcionesPago();
        $this->conexion = Yii::app()->db;
    }
    
    
    public function registrarOpciones($oImport)
    {
        //$this->getInsertOpciones();
        $lineas = $oImport->getLinesDoc();
        //$campos = $this->getCamposBD();
        
        if($lineas !== null)
        {
            $this->setComando($this->getInsertOpciones());
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
                            //var_dump($campos);var_dump($value);die;
                            $this->comando->bindValue($campos[$value], ValidaDatos::validar($tipoDatos[$value], $array[$key]) );
                        }
                    }
                    
                    if($control)
                    {
                        $oImport->procesados += 1;
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
    
    
    private function getInsertOpciones()
    {
        $campos = implode(',', array_values($this->getCamposBD()));
        return "INSERT INTO db_cancelomideuda.usr_opciones_pago ( ".str_replace(':', '', $campos ).") VALUES (".$campos.");";
    }
    
    
    public function getCamposBD()
    {
        return array(
            'idunicodeuda'=>':id_unica_deuda', 'nrocuota'=>':nro_cuota', 'montocuota'=>':monto_cuota',
            'linkcuota'=>':link_cuota', 'codigocupon'=>':codigo_cupon', 'fechavencimiento'=>':fecha_vencimiento');
    }
    
    
    public function getCampostipos()
    {
        return array(
            
            'idunicodeuda'=>'VARCHAR', 'nrocuota'=>'INTEGER', 'montocuota'=>'VARCHAR',
            'linkcuota'=>'URL', 'codigocupon'=>'VARCHAR', 'fechavencimiento'=>'DATE'
        );
    }
    
    
    public function getListOpcionesPago($idunicodeuda)
    {
        if(is_numeric($idunicodeuda))
        {
            $criteria=new CDbCriteria;
            $criteria->distinct = true;
            $criteria->select = "id_unica_deuda, nro_cuota, monto_cuota, link_cuota, codigo_cupon, fecha_vencimiento";
            $criteria->limit = 5;            
            
            if(Yii::app()->user->checkAccess('USER-AGENTE'))
            {
                $criteria->condition = " id_unica_deuda = '".$idunicodeuda."'";
            }
            
            
            return $this->modelo->findAll($criteria);
        }
        
    }
    
    
}