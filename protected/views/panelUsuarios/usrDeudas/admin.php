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
      <a href="#">Deudas Activas</a>
    </li>
    <li class="breadcrumb-item active">Administrador</li>
</ol>
<div class="row" id="mensaje_de_proceso"  style="display:none;">
	<?php if(Yii::app()->user->hasFlash('deudasactivas')):?>
        <div class="info">
            <?php echo "Usted no posee deudas activas: ".Yii::app()->user->getFlash('deudasactivas'); ?>
        </div>
    <?php endif; ?>
</div>
<div class="card mb-3">
    <div class="card-header">
    <div class="card-body">
      <?php 
      if(!empty($deudas)):
        
        foreach ($deudas as $key=>$value):
            
        $entidad = $model->getInfoEntidad($value->identidad);
      ?>
      <div class="row" >
      	<div class="col-md-2">
      		<img class="d-flex mr-3" width="50%" src="<?php echo $baseUrl."/upload/img/".$entidad->logo; ?>" alt="">
      	</div>
      	<div class="col-md-6">
      		<div class="row">
      			<div class="col-md-12">
      				<div class="row">
      					<h4 class="list-group-item-heading"><?php echo $entidad->nombre_entidad;?></h4>
      				</div>
      				<div class="row">
      					<p>
      						<?php echo $value->descripcion_deuda."<br />";?>
                    		<?php echo "$ ". number_format($value->deuda_total,2,".",",")."<br />";?>
      					</p>
      				</div>
      			</div>
      		</div>  		
      	</div>
      	<div class="col-md-4">
      		<div class="row">
      			<div class="col-md-12">
      				<div class="row">
                      	<a href="<?php echo Yii::app()->createUrl('PanelUsuarios/DeudaDetalles', array('id'=>$value->id))?>" class="btn btn-default" data-id="<?php echo $value->id;?>" >
                      		<i class="fa fa-eye" aria-hidden="true"></i>
                      	</a>
              			<a href="<?php echo Yii::app()->createUrl('PanelUsuarios/Mensajes', array('id'=>$value->identidad))?>" class="btn btn-default" data-id="<?php echo $value->id;?>" >
                      		<i class="fa fa-envelope-o" aria-hidden="true"></i>
                      	</a>
                      	<a href="#" class="btn btn-default" data-id="<?php echo $value->id;?>" >
                      		<i class="fa fa-volume-up" aria-hidden="true"></i>
                      	</a>
              		</div>
      			</div>
      		</div>
      	</div>
      </div>
      <?php 
        endforeach;
        
      endif;
      ?>
    </div>
</div>

