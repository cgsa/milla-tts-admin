<?php
/* @var $this UsrMensajesController */
/* @var $model UsrMensajes */

$this->breadcrumbs=array(
	'Usr Mensajes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UsrMensajes', 'url'=>array('index')),
	array('label'=>'Create UsrMensajes', 'url'=>array('create')),
	array('label'=>'Update UsrMensajes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UsrMensajes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UsrMensajes', 'url'=>array('admin')),
);
?>

<h1>View UsrMensajes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'identidad',
		'idusuario',
		'asunto',
		'mensaje',
		'tipo',
		'fecha_carga',
		'estadomensaje',
		'iduser',
	),
)); ?>
