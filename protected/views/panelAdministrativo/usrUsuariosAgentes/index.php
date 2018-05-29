<?php
/* @var $this UsrUsuariosAgentesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usr Usuarios Agentes',
);

$this->menu=array(
	array('label'=>'Create UsrUsuariosAgentes', 'url'=>array('create')),
	array('label'=>'Manage UsrUsuariosAgentes', 'url'=>array('admin')),
);
?>

<h1>Usr Usuarios Agentes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
