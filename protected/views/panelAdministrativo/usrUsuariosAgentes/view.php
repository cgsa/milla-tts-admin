<?php
/* @var $this UsrUsuariosAgentesController */
/* @var $model UsrUsuariosAgentes */

$this->breadcrumbs=array(
	'Usr Usuarios Agentes'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List UsrUsuariosAgentes', 'url'=>array('index')),
	array('label'=>'Create UsrUsuariosAgentes', 'url'=>array('create')),
	array('label'=>'Update UsrUsuariosAgentes', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete UsrUsuariosAgentes', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage UsrUsuariosAgentes', 'url'=>array('admin')),
);
?>

<h1>View UsrUsuariosAgentes #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'identidad',
		'telefono_particular',
		'telefono_movil',
		'estadoagente',
		'fecha_carga',
	),
)); ?>
