<?php
/* @var $this UsrMensajesController */
/* @var $model UsrMensajes */

$this->breadcrumbs=array(
	'Usr Mensajes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UsrMensajes', 'url'=>array('index')),
	array('label'=>'Create UsrMensajes', 'url'=>array('create')),
	array('label'=>'View UsrMensajes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UsrMensajes', 'url'=>array('admin')),
);
?>

<h1>Update UsrMensajes <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>