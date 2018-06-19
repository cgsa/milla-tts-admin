<?php
/* @var $this UsrUsuariosAgentesController */
/* @var $model UsrUsuariosAgentes */

$this->breadcrumbs=array(
	'Usr Usuarios Agentes'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List UsrUsuariosAgentes', 'url'=>array('index')),
	array('label'=>'Create UsrUsuariosAgentes', 'url'=>array('create')),
	array('label'=>'View UsrUsuariosAgentes', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage UsrUsuariosAgentes', 'url'=>array('admin')),
);
?>

<h1>Update UsrUsuariosAgentes <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>