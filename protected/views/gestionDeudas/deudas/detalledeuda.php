<?php 

function porcentajeOFF( $cuota, $valor1, $valor2 )
{
    $valorQuita = $cuota * $valor2;
    $val = -1 * ($valorQuita/$cuota);
    return  $val;
}

$deudaTotal = number_format($model->deuda_total,2);
?>
<!-- Start Row -->  
    <div class="row">
        
        <!-- Horizontal form -->
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <h4 class="m-b-30 m-t-0">Datos Generales</h4>
                    <dl class="row" >
                        <dt class="col-sm-4">Entidad:</dt>
                        <dd class="col-sm-8"><?php echo $model->identidad;?></dd>
                        <dt class="col-sm-4">Nombre Cliente:</dt>
                        <dd class="col-sm-8"><?php echo $model->nombre_cliente;?></dd>
                        <dt class="col-sm-4">RFC:</dt>
                        <dd class="col-sm-8"><?php echo $model->rfc_cliente;?></dd>
                        <dt class="col-sm-4">Clasificación:</dt>
                        <dd class="col-sm-8"><?php echo $model->clasificacion_cliente;?></dd>
                        <dt class="col-sm-4">Fecha de Atraso:</dt>
                        <dd class="col-sm-8"><?php echo date("d-m-Y", strtotime($model->fecha_atraso));?></dd>
                        <dt class="col-sm-4">Fecha de Lote:</dt>
                        <dd class="col-sm-8"><?php echo date("d-m-Y", strtotime($model->fecha_lote));?></dd>
                        <dt class="col-sm-4">Nro Producto:</dt>
                        <dd class="col-sm-8"><?php echo $model->nro_producto;?></dd>
                        <dt class="col-sm-4">Descripción:</dt>
                        <dd class="col-sm-8"><?php echo $model->descripcion_deuda;?></dd>
                        <dt class="col-sm-4">Deuda Total:</dt>
                        <dd class="col-sm-8"><?php echo $deudaTotal;?></dd>
                    </dl>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
        
        <!-- Horizontal form -->
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <h4 class="m-b-30 m-t-0">Campos Adicionales</h4>
                    <?php 
                    $criteria=new CDbCriteria;
                    $criteria->condition = " identidad = ".$model->identidad;
                    $row = EtiquetasCamposAdicionales::model()->find($criteria);
                    ?>
                    <dl class="row" >
                        <dt class="col-sm-4"><?php echo ($etiqueta != '' && !empty($etiqueta->adicional01))? $etiqueta->adicional01 : 'Adicional 1'; ?>:</dt>
                        <dd class="col-sm-8"><?php echo ($model->adicional01 != "")? $model->adicional01 : '&nbsp;&nbsp;&nbsp;' ;?></dd>
                        <dt class="col-sm-4"><?php echo ($etiqueta != '' && !empty($etiqueta->adicional02))? $etiqueta->adicional02 : 'Adicional 2'; ?>:</dt>
                        <dd class="col-sm-8"><?php echo ($model->adicional02 != "")? $model->adicional02 : '&nbsp;&nbsp;&nbsp;' ;?></dd>
                        <dt class="col-sm-4"><?php echo ($etiqueta != '' && !empty($etiqueta->adicional03))? $etiqueta->adicional03 : 'Adicional 3'; ?>:</dt>
                        <dd class="col-sm-8"><?php echo ($model->adicional03 != "")? $model->adicional03 : '&nbsp;&nbsp;&nbsp;' ;?></dd>
                        <dt class="col-sm-4"><?php echo ($etiqueta != '' && !empty($etiqueta->adicional04))? $etiqueta->adicional04 : 'Adicional 4'; ?>:</dt>
                        <dd class="col-sm-8"><?php echo ($model->adicional04 != "")? $model->adicional04 : '&nbsp;&nbsp;&nbsp;' ;?></dd>
                        <dt class="col-sm-4"><?php echo ($etiqueta != '' && !empty($etiqueta->adicional05))? $etiqueta->adicional05 : "Adicional 5"; ?>:</dt>
                        <dd class="col-sm-8"><?php echo ($model->adicional05 != "")? $model->adicional05 : '&nbsp;&nbsp;&nbsp;' ;?></dd>
                    </dl>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
        
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <h4 class="m-b-30 m-t-0">Ofertas de pago</h4>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                  <th>Nro Cuotas</th>
                                  <th>Monto</th>
                                  <th>Vencimiento</th>
                                  <th>Quita %</th>
                                </tr>
                                </thead>
                                <tbody> 
                                <?php 
                                if($cuotas):
                                ?> 
                                	<?php 
                                	foreach($cuotas AS $key=>$value):                                	
                                	$montocuota = number_format($value->monto_cuota,2);
                                	?>
                                	<tr>
                                		<td><?php echo $value->nro_cuota;?></td>
                                		<td><?php echo $montocuota;?></td>
                                		<td><?php echo $value->fecha_vencimiento;?></td>
                                		<td><?php 
                                		$porcentaje = porcentajeOFF($value->nro_cuota,$deudaTotal,$montocuota);
                                		
                                		if($porcentaje > 0)
                                		{
                                		    $porcentaje = 0;
                                		}
                                		
                                		echo $porcentaje;?></td>
                                	</tr>
                                	<?php 
                                	endforeach;
                                	?>
                            	<?php 
                            	endif;
                            	?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                	<div class="row">
                    	<div class="col-xs-6 col-sm-3 m-b-30">
                            <div class="btn-group">
                                <a href="<?php echo Yii::app()->createUrl("/GestionDeudas/importar");?>" class="btn btn-primary waves-effect">Volver</a>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div> 
    <!-- End Row -->