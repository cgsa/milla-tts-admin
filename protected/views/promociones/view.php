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
                <dl class="row" >
                    <dt class="col-sm-4">Lugar:</dt>
                    <dd class="col-sm-8"><?php echo $model->idLugar->nombre;?></dd>
                    <dt class="col-sm-4">Total Millas:</dt>
                    <dd class="col-sm-8"><?php echo $model->total_millas;?></dd>
                    <dt class="col-sm-4">Cant Pasajes:</dt>
                    <dd class="col-sm-8"><?php echo $model->cant_pasajes;?></dd>
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

