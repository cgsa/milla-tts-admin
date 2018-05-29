<?php
/* @var $this UsrMensajesController */
/* @var $model UsrMensajes */

$this->breadcrumbs=array(
	'Usr Mensajes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UsrMensajes', 'url'=>array('index')),
	array('label'=>'Manage UsrMensajes', 'url'=>array('admin')),
);
?>

<h1>Create UsrMensajes</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>