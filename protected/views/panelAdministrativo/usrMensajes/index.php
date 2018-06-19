<?php
/* @var $this UsrMensajesController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usr Mensajes',
);

$this->menu=array(
	array('label'=>'Create UsrMensajes', 'url'=>array('create')),
	array('label'=>'Manage UsrMensajes', 'url'=>array('admin')),
);
?>

<h1>Usr Mensajes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
