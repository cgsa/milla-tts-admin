<?php
/* @var $this BannerController */
/* @var $model Banner */
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
                    <dt class="col-sm-4">Controlador:</dt>
                    <dd class="col-sm-8"><?php echo $model->controlador;?></dd>
                    <dt class="col-sm-4">Publicación:</dt>
                    <dd class="col-sm-8"><?php echo $model->id_contralador;?></dd>
                    <dt class="col-sm-4">Nombre:</dt>
                    <dd class="col-sm-8"><?php echo $model->nombre;?></dd>
                    <dt class="col-sm-4">Descripcion:</dt>
                    <dd class="col-sm-8"><?php echo $model->descripcion;?></dd>
                    <dt class="col-sm-4">Estatus:</dt>
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
            			<a href="<?php echo Yii::app()->createUrl("/Banner/admin");?>"  class="btn btn-danger" >Volver</a>	
            		</div>
            	</div>
            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- col -->
</div>
<!-- End Row -->
