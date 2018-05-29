<?php
/* @var $this UsrDeudasController */
/* @var $model UsrDeudas */
/* @var $form CActiveForm */
?>

<div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Formulario de Mensajes</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>        
      </div>
      <div class="modal-body" style="max-height: 200px;overflow-y: scroll;">  
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
                <dd class="col-sm-8"><?php echo number_format($model->deuda_total,2);?></dd>
            </dl> 
            <div class="row">
        		<div class="col-md-12">
        			<div class="card mb-3">
                        <div class="card-header">
                         	Ofertas de pago
                        </div>
                        <table class="table table-bordered" >
                            <thead>
                                <tr>
                                  <th>Nro Cuotas</th>
                                  <th>Monto</th>
                                  <th>Vencimiento</th>
                                  <th>Quita %</th>
                                </tr>
                            </thead>
                            <tbody>
                            	<tr>
                            		<td><?php echo $model->oferta1_qcuotas;?></td>
                            		<td><?php echo $model->oferta1_montocuota;?></td>
                            		<td><?php echo $model->oferta1_primer_vencimiento;?></td>
                            		<td><?php echo $model->oferta1_porcentaje_quita;?></td>
                            	</tr>
                            	<tr>
                            		<td><?php echo $model->oferta2_qcuotas;?></td>
                            		<td><?php echo $model->oferta2_montocuota;?></td>
                            		<td><?php echo $model->oferta2_primer_vencimiento;?></td>
                            		<td><?php echo $model->oferta2_porcentaje_quita;?></td>
                            	</tr>
                            	<tr>
                            		<td><?php echo $model->oferta3_qcuotas;?></td>
                            		<td><?php echo $model->oferta3_montocuota;?></td>
                            		<td><?php echo $model->oferta3_primer_vencimiento;?></td>
                            		<td><?php echo $model->oferta3_porcentaje_quita;?></td>
                            	</tr>
                            	<tr>
                            		<td><?php echo $model->oferta4_qcuotas;?></td>
                            		<td><?php echo $model->oferta4_montocuota;?></td>
                            		<td><?php echo $model->oferta4_primer_vencimiento;?></td>
                            		<td><?php echo $model->oferta4_porcentaje_quita;?></td>
                            	</tr>
                            	<tr>
                            		<td><?php echo $model->oferta5_qcuotas;?></td>
                            		<td><?php echo $model->oferta5_montocuota;?></td>
                            		<td><?php echo $model->oferta5_primer_vencimiento;?></td>
                            		<td><?php echo $model->oferta5_porcentaje_quita;?></td>
                            	</tr>
                            </tbody>
                    	</table>
                     </div>            		
            	</div>
        	</div>     	       
 	 	</div>
 	 	<div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
     </div>     
</div>
      
      <?php /*
      <dl class="row">
            <dt class="col-sm-4">Fecha Atraso:</dt>
            <dd class="col-sm-8"><?php echo date("d-m-Y", strtotime($deudas->fecha_atraso));?></dd>
        </dl>  
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <?php echo CHtml::submitButton('Responder',array('class'=>'btn btn-primary btn-procesar-datos')); ?>
      </div>
      ?>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

