<?php 
/* @var $this SiteController */

$baseUrl = Yii::app()->request->baseUrl;

$cargacompleta = Yii::app()->user->hasFlash('success')? 'true' : 'false';

Yii::app()->clientScript->registerScript('search', "
    
    var cargacompleta = '".$cargacompleta."';
    
      if(cargacompleta == 'true')
      {
         $('#mensaje_de_proceso').fadeIn('slow');
         $( '#mensaje_de_proceso' ).fadeOut( 4500 );
      }

    $('#datatable').dataTable();

    $('.btn-dialogo-importador').click(function()
    {

        var _action = $(this).attr('data-action');
        var param = {'action':_action};
        bloqueoPantalla();
    
        $.ajax(
        {
            url: '".Yii::app()->createUrl('GestionDeudas/DialogoImportador')."',
            type: 'POST',
            data: param,
            dataType: 'json',
            success: function(_res)
            {
                desbloquePantalla();
                if(_res.status)
                {
                    //$('#modal_contenido').html(_res.content);
                    //$('#modalImportar').modal({show:true})
                    $('#modalDialogo').html(_res.content);
                    $('#modalDialogo').modal({show:true})
                }
                else
                {
                    swal(_res.mensaje);
                    
                }
            },
            error: function(_error)
            {
                desbloquePantalla();
                swal( 'Se produjó un error al procesar los datos.' );
            }
        });


        return false;

    });


    $('.cls_etiquetas').click(function()
    {
        var id = $(this).attr('data-entidad');
        var param = {'action':'E', 'entidad': id};
        bloqueoPantalla();

        $.ajax(
        {
            url: '".Yii::app()->createUrl('PanelAdministrativo/OperacionConfiguracion')."',
            type: 'POST',
            data: param,
            dataType: 'json',
            success: function(_res)
            {
                desbloquePantalla();
                if(_res.status)
                {
                    $('#modalDialogo').html(_res.formulario);
                    $('#modalDialogo').modal({show:true})
                }
                else
                {
                    swal(_res.mensaje);
                    
                }
            },
            error: function(_error)
            {
                desbloquePantalla();
                swal( 'Se produjó un error al procesar los datos.' );
            }
        });


        return false;
    });


    
    $('body').delegate('.btn-actualizar-etiquetas','click',function()
    {
        var param = $('#usr_etiquetas_campos_adicionales').serialize();
        bloqueoPantalla();

        $.ajax(
        {
            url: '".Yii::app()->createUrl('PanelAdministrativo/OperacionConfiguracion')."',
            type: 'POST',
            data: param,
            dataType: 'json',
            success: function(_res)
            {
                desbloquePantalla();
                if(_res.status)
                {
                    $('#modalDialogo').modal('hide');
                    swal(_res.mensaje); 
                }
                else
                {
                    swal(_res.mensaje);
                    
                }
            },
            error: function(_error)
            {
                desbloquePantalla();
                swal( 'Se produjó un error al procesar los datos.' );
            }
        });


        return false;

    });


    
    $('body').delegate('.tr_deuda_activa','click',function()
    {
        var id = $(this).attr('data-id');
        var param = {'action':'DD', 'id': id};
        bloqueoPantalla();

        $.ajax(
        {
            url: '".Yii::app()->createUrl('PanelAdministrativo/OperacionDeudas')."',
            type: 'POST',
            data: param,
            dataType: 'json',
            success: function(_res)
            {
                desbloquePantalla();
                if(_res.status)
                {
                    $('#modalDialogo').html(_res.formulario);
                    $('#modalDialogo').modal({show:true})
                }
                else
                {
                    swal(_res.mensaje);
                    
                }
            },
            error: function(_error)
            {
                desbloquePantalla();
                swal( 'Se produjó un error al procesar los datos.' );
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
   
    <div class="row" id="mensaje_de_proceso"  style="display:none;">
    	<?php if(Yii::app()->user->hasFlash('success')):?>
            <div class="info">
                <?php echo "La importación se realizó con éxito, se procesaron: ".Yii::app()->user->getFlash('success')." registros"; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <!-- Start Row -->  
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-bodedy">
                    <div class="row">
                    	<div class="col-xs-6 col-sm-4 m-b-30">
                            <div class="btn-group">
                                <button type="button" data-toggle="tooltip" data-action="D" class="btn btn-primary waves-effect btn-dialogo-importador">Cargar Deudas</button>
                                <button type="button" data-toggle="tooltip" data-action="O" class="btn btn-default waves-effect btn-dialogo-importador">Cargar Cuotas</button>                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                	<th>Id Deuda</th>
                                    <th>Fecha Atraso</th>
                                    <th>Cliente</th>
                                    <th>RFC</th>
                                    <th>Nro Producto</th>
                                    <th>Monto Total</th>
                                    <th>Cuota</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                              	foreach ($model as $key =>$value):
                              	?>
                                    <tr>
                                      <td><?php echo $value->identificacion_unica_cliente;?></td>
                                      <td><?php echo date("d-m-Y", strtotime($value->fecha_atraso));?></td>
                                      <td><?php echo $value->nombre_cliente;?></td>
                                      <td><?php echo $value->rfc_cliente;?></td>
                                      <td><?php echo $value->nro_producto;?></td>
                                      <td><?php echo number_format($value->deuda_total,2);?></td>
                                      <td><?php echo $value->oferta1_qcuotas;?></td>
                                      <td>
                                      	<a href="<?php echo Yii::app()->createUrl("/GestionDeudas/importar",array('id'=>$value->id));?>">
                                      		<i class="ion-eye"></i>
                                      	</a>
                                      </td>
                                    </tr>
                                <?php 
                                endforeach;
                                ?>                                                             
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> 
    <!-- End Row -->                            
	<div class="modal fade" id="modalDialogo" tabindex="-1" role="dialog"></div>
