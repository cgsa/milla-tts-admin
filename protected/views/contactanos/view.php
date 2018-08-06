<?php
/* @var $this ContactanosController */
/* @var $model Contactanos */

?>

<!-- Start Row -->  
<div class="row">
	<!-- Horizontal form -->
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h4 class="m-t-0 m-b-30">Mensaje</h4>
                <dl class="row" >
                    <dt class="col-sm-4">Nombre:</dt>
                    <dd class="col-sm-8"><?php echo $model->nombre." ".$model->apellido."&nbsp;";?></dd>
                    <dt class="col-sm-4">Email:</dt>
                    <dd class="col-sm-8"><?php echo $model->email."&nbsp;";?></dd>
                    <dt class="col-sm-4">Teléfono:</dt>
                    <dd class="col-sm-8"><?php echo $model->telefono."&nbsp;";?></dd>
                    <dt class="col-sm-4">Mensaje:</dt>
                    <dd class="col-sm-8"><?php echo $model->mensaje."&nbsp;";?></dd>
                    <dt class="col-sm-4">Fecha de Registro:</dt>
                    <dd class="col-sm-8"><?php echo date("d-m-Y", strtotime($model->fecha_registro));?></dd>
                </dl>
                <div class="row">
            		<div>
            			<a href="<?php echo Yii::app()->createUrl("/Contactanos/admin");?>"  class="btn btn-danger" >Volver</a>	
            		</div>
            	</div>
            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- col -->
</div>
<!-- End Row -->