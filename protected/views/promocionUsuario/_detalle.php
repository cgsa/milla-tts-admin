<?php

$criteria=new CDbCriteria;
$criteria->condition = "id_user =".$model->id_user;
$usuario = UsuarioSistema::model()->find($criteria);
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
                                		<td></td>
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