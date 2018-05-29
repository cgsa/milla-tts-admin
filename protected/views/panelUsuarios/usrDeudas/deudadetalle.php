<?php
/* @var $this PanelUsuariosController */

$baseUrl = Yii::app()->request->baseUrl;

$cargacompleta = Yii::app()->user->hasFlash('success')? 'true' : 'false';


Yii::app()->clientScript->registerScript('search', "
    
    var cargacompleta = '".$cargacompleta."';
    
      if(cargacompleta == 'true')
      {
         $('#mensaje_de_proceso').fadeIn('slow');
         $( '#mensaje_de_proceso' ).fadeOut( 4500 );
      }
    
    $('#btn-dialogo-importador').click(function()
    {
        var param = {'action':'D'};
        bloqueoPantalla();
    
        $.ajax(
        {
            url: '".Yii::app()->createUrl('PanelAdministrativo/DialogoImportador')."',
            type: 'POST',
            data: param,
            dataType: 'json',
            success: function(_res)
            {
                desbloquePantalla();
                if(_res.status)
                {
                    $('#modal_contenido').html(_res.content);
                    $('#modalImportar').modal({show:true})
                }
                else
                {
                    bootbox.alert(_res.mensaje);
    
                }
            },
            error: function(_error)
            {
                desbloquePantalla();
                bootbox.alert('Se produjó un error en el procesamiento del archivo.');
            }
        });
    
    
        return false;
    
    });
    
    
    function bloqueoPantalla()
    {
        $.blockUI({ message: 'Espere un momento por favor...', css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#000',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: .5,
            color: '#fff'
        } });
    
    }
    
    
    function desbloquePantalla()
    {
        $(document).ready(function()
        {
            $.unblockUI({
                onUnblock: function(){
                }
            });
        });
    }
    
");
?>
<div id="modal_contenido" ></div>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="<?php echo Yii::app()->createUrl("PanelUsuarios/Deudas");?>">Deudas Activas</a>
    </li>
    <li class="breadcrumb-item active">Detalle</li>
</ol>
<div class="row" id="mensaje_de_proceso"  style="display:none;">
	<?php if(Yii::app()->user->hasFlash('deudasactivas')):?>
        <div class="info">
            <?php echo "Usted no posee deudas activas: ".Yii::app()->user->getFlash('deudasactivas'); ?>
        </div>
    <?php endif; ?>
</div>
<?php 
if(!empty($deudas)):
    $entidad = $model->getInfoEntidad($deudas->identidad);?>  
    <div class="row">
    	<div class="col-md-6">    	
        	<div class="small">    
                <dl class="row">
                	<dt class="col-sm-2">
                		<img class="d-flex mr-3" width="100%" src="<?php echo $baseUrl."/upload/img/".$entidad->logo; ?>" alt="">
                	</dt>
                  	<dd class="col-sm-10"><?php echo $entidad->nombre_entidad;?></dd>
                  	
                  	<dt class="col-sm-12">Deuda Total:</dt>
                  	<dd class="col-sm-12"><?php echo "$ ". number_format($deudas->deuda_total,2,".",",")."<br />";?></dd>
                  	
                  	<dt class="col-sm-12">Características:</dt>
                  	<dd class="col-sm-12"><?php echo $deudas->descripcion_deuda."<br />";?></dd>
                </dl> 
            </div> 
        </div>
        <div class="col-md-6">
        	<div class="small">
                <dl class="row">
                  <dt class="col-sm-4">Fecha Atraso:</dt>
                  <dd class="col-sm-8"><?php echo date("d-m-Y", strtotime($deudas->fecha_atraso));?></dd>
                  
                  <dt class="col-sm-4">Deuda Total:</dt>
                  <dd class="col-sm-8"><?php echo "$ ". number_format($deudas->deuda_total,2,".",",")."<br />";?></dd>
                  
                  <dt class="col-sm-4">Opciones de Pago:</dt>
                  <dd class="col-sm-8">&nbsp;</dd>
                  <?php 
                  if(!empty($deudas->oferta1_montocuota)):
                  ?>
                  <dt class="col-sm-4"><input type="radio" name="rd_cuota" >1 Cuota: <?php echo "$ ". number_format($deudas->oferta1_montocuota,2,".",",")."<br />";?></dt>
                  <dd class="col-sm-8">Vence: <?php echo date("d-m-Y", strtotime($deudas->oferta1_primer_vencimiento));?></dd>
                  <?php 
                  endif;
                  ?>
                  <?php 
                  if(!empty($deudas->oferta2_montocuota)):
                  ?>
                  <dt class="col-sm-4"><input type="radio" name="rd_cuota" >2 Cuota: <?php echo "$ ". number_format($deudas->oferta2_montocuota,2,".",",")."<br />";?></dt>
                  <dd class="col-sm-8">Vence: <?php echo date("d-m-Y", strtotime($deudas->oferta2_primer_vencimiento));?></dd> 
                  <?php 
                  endif;
                  ?>
                  <?php 
                  if(!empty($deudas->oferta3_montocuota)):
                  ?>
                  <dt class="col-sm-4"><input type="radio" name="rd_cuota" >3 Cuota: <?php echo "$ ". number_format($deudas->oferta3_montocuota,2,".",",")."<br />";?></dt>
                  <dd class="col-sm-8">Vence: <?php echo date("d-m-Y", strtotime($deudas->oferta3_primer_vencimiento));?></dd>
                  <?php 
                  endif;
                  ?>
                  <dt class="col-sm-1">&nbsp;</dt>
                  <dd class="col-sm-11">
                  	<button type="button" data-id="<?php echo $deudas->id;?>" class="btn btn-outline-success" >Hacé TU OFERTA</button>
                  	<button type="button" data-id="<?php echo $deudas->id;?>" class="btn btn-outline-primary" >PAGAR</button>
                  </dd>                 
                </dl>
            </div>
        </div>
    </div>
<?php         
endif;
?>

