<?php
/* @var $this PromocionesController */
/* @var $data Promociones */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_lugar')); ?>:</b>
	<?php echo CHtml::encode($data->id_lugar); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cant_millas')); ?>:</b>
	<?php echo CHtml::encode($data->cant_millas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cant_cuotas')); ?>:</b>
	<?php echo CHtml::encode($data->cant_cuotas); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_vencimiento')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_vencimiento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cant_pasajes')); ?>:</b>
	<?php echo CHtml::encode($data->cant_pasajes); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('codigo_barra')); ?>:</b>
	<?php echo CHtml::encode($data->codigo_barra); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_imagen')); ?>:</b>
	<?php echo CHtml::encode($data->id_imagen); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visibilidad')); ?>:</b>
	<?php echo CHtml::encode($data->visibilidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_fin')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_fin); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_registro')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_registro); ?>
	<br />

	*/ ?>

</div>