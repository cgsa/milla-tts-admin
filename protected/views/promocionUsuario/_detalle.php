<?php

$criteria=new CDbCriteria;
$criteria->condition = "id_user =".$model->id_user;
$usuario = UsuarioSistema::model()->find($criteria);

Yii::app()->clientScript->registerScript('detalles', "
    
    
    $('#datatable').dataTable();

    $('body').delegate('.btn-operaciones','click',function()
    {
        var id = $(this).attr('data-id');
        var action = $(this).attr('data-action');
        var param = {'action': action,'id': id};
        bloqueoPantalla();
        
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('PromocionUsuario/Formulario')."',
            type:       'POST',
            data:       param,
            dataType:   'JSON',
            success:    function(_res)
            {
                desbloquePantalla();
                if(_res.status)
                {                   
                    //swal( _res.mensaje );
                    //location.reload();
                    $('#modalDialogo').html(_res.formulario);
                    $('#modalDialogo').modal({show:true})
                }
                else
                {
                    bootbox.alert(_res.mensaje);
                    swal( _res.mensaje );
                }
            },
            error: function(_error)
            {
                desbloquePantalla();
                swal( 'Se produjó un error en el procesamiento los datos.' );
            }
        }); 

        return false;

    });


    
    $('body').delegate('.btn-procesar-datos','click',function()
    {
        var param = $('#pagos_promociones_form').serialize();
        bloqueoPantalla();

        $.ajax(
        {
            url: '".Yii::app()->createUrl('PromocionUsuario/Registrar')."',
            type: 'POST',
            data: param,
            dataType: 'json',
            success: function(_res)
            {
                desbloquePantalla();
                if(_res.status)
                {
                    swal(_res.mensaje); 
                    location.reload();
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

<!-- Start Row -->  
    <div class="row">
        
        <!-- Horizontal form -->
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <h4 class="m-b-30 m-t-0">Datos Usuario</h4>
                    <dl class="row" >
                        <dt class="col-sm-4">Nombre:</dt>
                        <dd class="col-sm-8"><?php echo $usuario->nombre;?></dd>
                        <dt class="col-sm-4">Apellido:</dt>
                        <dd class="col-sm-8"><?php echo $usuario->apellido;?></dd>
                        <dt class="col-sm-4">E-mail:</dt>
                        <dd class="col-sm-8"><?php echo $usuario->email;?></dd>
                        <dt class="col-sm-4">Teléfono:</dt>
                        <dd class="col-sm-8"><?php echo $usuario->telefono;?></dd>
                    </dl>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
        
        <!-- Horizontal form -->
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <h4 class="m-b-30 m-t-0">Datos de Compra</h4>                    
                    <dl class="row" >
                        <dt class="col-sm-4">Promoción:</dt>
                        <dd class="col-sm-8"><?php echo $model->idPromocion->titulo;?></dd>
                        <dt class="col-sm-4">Cantidad de Cuotas:</dt>
                        <dd class="col-sm-8"><?php echo $model->idCuotaPromocion->cant_cuotas;?></dd>
                        <dt class="col-sm-4">Cantidad de Millas:</dt>
                        <dd class="col-sm-8"><?php echo $model->idCuotaPromocion->cant_millas;?></dd>
                        <dt class="col-sm-4">Fecha Activa:</dt>
                        <dd class="col-sm-8"><?php echo date("d-m-Y", strtotime($model->idCuotaPromocion->fecha_activa));?></dd>
                        <dt class="col-sm-4">Total de Millas:</dt>
                        <dd class="col-sm-8"><?php echo $model->total_millas;?></dd>
                        <dt class="col-sm-4">Monto total:</dt>
                        <dd class="col-sm-8"><?php echo $model->monto_total;?></dd>
                        <dt class="col-sm-4">Estatus:</dt>
                        <dd class="col-sm-8"><?php echo $model->getStatusLiteral($model->status);?></dd>
                    </dl>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
        <?php 
        if( $model->status == 1 || $model->status == 2 ):
        ?>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <h4 class="m-b-30 m-t-0">Cuotas Programadas</h4>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                  <th>Nro Cuotas</th>
                                  <th>Cupón</th>
                                  <th>Reference Id</th>
                                  <th>Código Pago</th>
                                  <th>Fecha Pago</th>
                                  <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                	$criteria=new CDbCriteria;
                                	$criteria->condition = " id_promocion_usuario = ".$model->id;
                                	$criteria->order = "id ASC";
                                	$rows = PagosPromociones::model()->findAll($criteria);
                                	$i = 1;
                                	foreach($rows AS $key=>$value):                                	
                                	
                                	?>
                                	<tr>
                                		<td><?php echo $i;?></td>
                                		<td><?php echo $value->cod_cupon;?></td>
                                		<td><?php echo $value->reference_id;?></td>
                                		<td><?php echo $value->cod_pago;?></td>
                                		<td><?php echo date("d-m-Y", strtotime($value->fecha_pago));?></td>
                                		<td>
                                			<?php 
                                			if($value->status != 1):
                                			?>
                                          	<a title="Cargar Pago" href="" class="btn btn-default btn-operaciones" data-action="C" data-id="<?php echo $value->id;?>" >
                                          		<i class="fa fa-check-square-o" aria-hidden="true"></i>
                                          	</a>
                                          	<?php 
                                          	endif;
                                          	?>
                                		</td>
                                	</tr>
                                	<?php 
                                	$i++;
                                	endforeach;
                                	?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
        endif;
        ?>
        
    </div> 
    <!-- End Row -->
	<div class="row">
		<div class="col-xs-1 col-sm-1" ></div>
    	<div class="col-xs-6 col-sm-3 m-b-30">
            <div class="btn-group">
                <a href="<?php echo Yii::app()->createUrl("/PromocionUsuario/admin");?>" class="btn btn-primary waves-effect">Volver</a>                                
            </div>
        </div>
    </div>
	<div class="modal fade" id="modalDialogo" tabindex="-1" role="dialog"></div>