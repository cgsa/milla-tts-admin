<?php
/* @var $this UsrEntidadesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usr Entidades',
);

$this->menu=array(
	array('label'=>'Create UsrEntidades', 'url'=>array('create')),
	array('label'=>'Manage UsrEntidades', 'url'=>array('admin')),
);
?>

<h1>Usr Entidades</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
