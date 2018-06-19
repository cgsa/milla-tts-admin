<?php
/* @var $this GaleriasController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Galeriases',
);

$this->menu=array(
	array('label'=>'Create Galerias', 'url'=>array('create')),
	array('label'=>'Manage Galerias', 'url'=>array('admin')),
);
?>

<h1>Galeriases</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
