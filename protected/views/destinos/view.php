<?php
/* @var $this DestinosController */
/* @var $model Destinos */

?>

<!-- Start Row -->  
<div class="row">
	<!-- Horizontal form -->
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h4 class="m-t-0 m-b-30">Horizontal form</h4>
                <dl class="row" >
                    <dt class="col-sm-4">Ciudad:</dt>
                    <dd class="col-sm-8"><?php echo $model->ciudad;?></dd>
                    <dt class="col-sm-4">Nombre:</dt>
                    <dd class="col-sm-8"><?php echo $model->nombre;?></dd>
                    <dt class="col-sm-4">Coordenadas:</dt>
                    <dd class="col-sm-8"><?php echo $model->coodenadas;?></dd>
                    <dt class="col-sm-4">Descripcion:</dt>
                    <dd class="col-sm-8"><?php echo $model->descripcion;?></dd>
                </dl>
                <div class="row">
            		<div>
            			<a href="<?php echo Yii::app()->createUrl("/Destinos/admin");?>"  class="btn btn-danger" >Volver</a>	
            		</div>
            	</div>
            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- col -->
</div>
<!-- End Row -->