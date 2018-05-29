<?php
/* @var $this PromocionesController */
/* @var $model Promociones */

$baseUrl = Yii::app()->request->baseUrl;
?>

<!-- Start Row -->  
<div class="row">
	<!-- Horizontal form -->
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h4 class="m-t-0 m-b-30">Horizontal form</h4>
                <dl class="row" >
                    <dt class="col-sm-4">Lugar:</dt>
                    <dd class="col-sm-8"><?php echo $model->idLugar->nombre;?></dd>
                    <dt class="col-sm-4">Cant: Millas</dt>
                    <dd class="col-sm-8"><?php echo $model->cant_millas;?></dd>
                    <dt class="col-sm-4">Cant. Cuotas:</dt>
                    <dd class="col-sm-8"><?php echo $model->cant_cuotas;?></dd>
                    <dt class="col-sm-4">Codigo Barra:</dt>
                    <dd class="col-sm-8"><?php echo $model->codigo_barra;?></dd>
                    <dt class="col-sm-4">F. Vencimiento:</dt>
                    <dd class="col-sm-8"><?php echo $model->fecha_vencimiento;?></dd>
                    <dt class="col-sm-4">F. Fin:</dt>
                    <dd class="col-sm-8"><?php echo $model->fecha_fin;?></dd>
                    <dt class="col-sm-4">Cant. Cuotas:</dt>
                    <dd class="col-sm-8"><?php echo ($model->status == 0)? 'Inactivo' : 'Activo';?></dd>
                </dl>
                <div class="row m-b-10">
                	<div class="col-sm-4"></div>
                	<div class="col-sm-8">
                		<img width="60%" src="<?php echo $baseUrl."/upload/img/".$model->idImagen->path;?>" />
                	</div>
                </div>
                <div class="row">
            		<div>
            			<a href="<?php echo Yii::app()->createUrl("/Promociones/admin");?>"  class="btn btn-danger" >Volver</a>	
            		</div>
            	</div>
            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- col -->
</div>
<!-- End Row -->

