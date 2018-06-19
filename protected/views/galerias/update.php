<?php
/* @var $this GaleriasController */
/* @var $model Galerias */

$this->breadcrumbs=array(
	'Galeriases'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Galerias', 'url'=>array('index')),
	array('label'=>'Create Galerias', 'url'=>array('create')),
	array('label'=>'View Galerias', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Galerias', 'url'=>array('admin')),
);
?>

<h1>Update Galerias <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>