<?php
/* @var $this GaleriasController */
/* @var $model Galerias */

$this->breadcrumbs=array(
	'Galeriases'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Galerias', 'url'=>array('index')),
	array('label'=>'Manage Galerias', 'url'=>array('admin')),
);
?>

<h1>Create Galerias</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>