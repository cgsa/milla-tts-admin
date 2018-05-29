<?php
/* @var $this DestinosController */
/* @var $data Destinos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('coodenadas')); ?>:</b>
	<?php echo CHtml::encode($data->coodenadas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_galeria')); ?>:</b>
	<?php echo CHtml::encode($data->id_galeria); ?>
	<br />


</div>