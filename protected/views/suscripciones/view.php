<?php
/* @var $this SuscripcionesController */
/* @var $model Suscripciones */

?>

<!-- Start Row -->  
<div class="row">
	<!-- Horizontal form -->
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h4 class="m-t-0 m-b-30">Horizontal form</h4>
                <dl class="row" >
                    <dt class="col-sm-4">Email:</dt>
                    <dd class="col-sm-8"><?php echo $model->email;?></dd>
                    <dt class="col-sm-4">Fecha Registro:</dt>
                    <dd class="col-sm-8"><?php echo $model->fecha_registro."&nbsp;";?></dd>
                    <dt class="col-sm-4">Estatus:</dt>
                    <dd class="col-sm-8"><?php echo ($model->status == 1)? 'Activo': 'Inactivo';?></dd>
                </dl>
                <div class="row">
            		<div>
            			<a href="<?php echo Yii::app()->createUrl("/Suscripciones/admin");?>"  class="btn btn-danger" >Volver</a>	
            		</div>
            	</div>
            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- col -->
</div>
<!-- End Row -->