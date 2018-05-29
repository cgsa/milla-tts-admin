<?php
/* @var $this PromocionesController */
/* @var $model Promociones */

$this->breadcrumbs=array(
	'Promociones'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Promociones', 'url'=>array('index')),
	array('label'=>'Create Promociones', 'url'=>array('create')),
	array('label'=>'Update Promociones', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Promociones', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Promociones', 'url'=>array('admin')),
);
?>

<h1>View Promociones #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_lugar',
		'cant_millas',
		'cant_cuotas',
		'fecha_vencimiento',
		'cant_pasajes',
		'codigo_barra',
		'id_imagen',
		'visibilidad',
		'status',
		'fecha_fin',
		'fecha_registro',
	),
)); ?>
