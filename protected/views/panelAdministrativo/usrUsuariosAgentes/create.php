<?php
/* @var $this UsrUsuariosAgentesController */
/* @var $model UsrUsuariosAgentes */

$this->breadcrumbs=array(
	'Usr Usuarios Agentes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List UsrUsuariosAgentes', 'url'=>array('index')),
	array('label'=>'Manage UsrUsuariosAgentes', 'url'=>array('admin')),
);
?>

<h1>Create UsrUsuariosAgentes</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>