<?php
/* @var $this DestinosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Destinoses',
);

$this->menu=array(
	array('label'=>'Create Destinos', 'url'=>array('create')),
	array('label'=>'Manage Destinos', 'url'=>array('admin')),
);
?>

<h1>Destinoses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
