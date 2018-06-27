<?php
//namespace protected\components;

class ClassCodigoBar
{
    
    private $date;
    
    private $config;
    
    private $oCuota;
    
    private $montoCuota;
    
    private $codeCuota;
    
    public $fecha1;
    
    public $fecha2;
    
    public $fechaPago1;
    
    public $fechaPago2;
    
    public $codeBar;
    
    
    public function __construct(  )
    {
        $this->date = date('d-m-Y');
        $this->config = Configuracion::model()->findByPk(1);
    }
    
    
    
    public function start( $index,$oCuotas )
    {
        $this->oCuota = $oCuotas;
        $this->setMontoCuota();
        $this->setCodeCuota();
        $this->fechaPago1 = $this->fechaPago1($index);
        $this->fechaPago2 = $this->fechaPago2($index);
        $this->generateCodeBar();
    }
    
    
    private function generateCodeBar()
    {
        $this->codeBar = $this->config->cod_empresa
        .$this->config->cod_subempresa
        .$this->codeCuota.$this->montoCuota.$this->fecha1
        .$this->montoCuota.$this->fecha2.$this->getRandom();
    }
    
    
    public function setMontoCuota()
    {
        $result1 = (float)$this->oCuota->idPromocionUsuario->monto_total / $this->oCuota->idPromocionUsuario->idCuotaPromocion->cant_cuotas;
        $result2 = number_format($result1,2, ',','.');
        $this->montoCuota = $this->completedNumberCode(str_replace(array('.',','), '', $result2), 7);
    }
    
    
    public function setCodeCuota()
    {
        $this->codeCuota = $this->completedNumberCode($this->oCuota->id, 11);
    }
    
    
    
    public function fechaPago1( $count = 0 )
    {
        $fecha = $this->date;
        $incremento = $count == 1? '+1 day': '+1 month';
        $nuevafecha = strtotime ( $incremento , strtotime ( $fecha ) ) ;
        $newfecha = date ( 'd-m-Y' , $nuevafecha );
        $this->setDayYear('fecha1', $newfecha);
        return date ( 'd-m-Y' , $newfecha );
    }
    
    
    public function fechaPago2( $count = 0 )
    {
        $fecha = $this->date;
        $incremento = ($count == 1)? '+7 day': '+'.$count.' month';
        $nuevafecha = strtotime ( $incremento , strtotime ( $fecha ) ) ;
        $newfecha = date ( 'd-m-Y' , $nuevafecha );
        $this->setDayYear('fecha2', $newfecha);
        return date ( 'd-m-Y' , $newfecha );
    }
    
    
    public function setDayYear( $attr, $fecha )
    {
        $this->$attr = $this->completedNumberCode( date('z',strtotime( $fecha )) , 3);  
    }
    
    
    public function getSingleYear()
    {
        return date( 'y', $this->date );
    }
    
    
    public function getRandom()
    {
        return rand(1,9);
    }
    
    
    public function completedNumberCode( $numero, $cantidad )
    {
        return str_pad($numero, $cantidad, "0", STR_PAD_LEFT);
    }
    
}

