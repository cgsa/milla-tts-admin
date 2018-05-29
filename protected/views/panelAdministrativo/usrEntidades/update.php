<?php
/* @var $this UsrEntidadesController */
/* @var $model UsrEntidades */

$this->breadcrumbs=array(
	'Usr Entidades'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UsrEntidades', 'url'=>array('index')),
	array('label'=>'Create UsrEntidades', 'url'=>array('create')),
	array('label'=>'View UsrEntidades', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UsrEntidades', 'url'=>array('admin')),
);
?>

<h1>Update UsrEntidades <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>