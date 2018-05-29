<?php
/* @var $this GaleriasController */
/* @var $model Galerias */

$this->breadcrumbs=array(
	'Galeriases'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Galerias', 'url'=>array('index')),
	array('label'=>'Create Galerias', 'url'=>array('create')),
	array('label'=>'Update Galerias', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Galerias', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Galerias', 'url'=>array('admin')),
);
?>

<h1>View Galerias #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre',
		'status',
		'fecha_registro',
	),
)); ?>
