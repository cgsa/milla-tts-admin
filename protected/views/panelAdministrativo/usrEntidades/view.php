<?php
/* @var $this UsrEntidadesController */
/* @var $model UsrEntidades */

$this->breadcrumbs=array(
	'Usr Entidades'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UsrEntidades', 'url'=>array('index')),
	array('label'=>'Create UsrEntidades', 'url'=>array('create')),
	array('label'=>'Update UsrEntidades', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UsrEntidades', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UsrEntidades', 'url'=>array('admin')),
);
?>

<h1>View UsrEntidades #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'nombre_entidad',
		'logo',
		'idestadoentidad',
		'fecha_carga',
	),
)); ?>
