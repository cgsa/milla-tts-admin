<?php
/* @var $this UsrEntidadesController */
/* @var $data UsrEntidades */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_entidad')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_entidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('logo')); ?>:</b>
	<?php echo CHtml::encode($data->logo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('idestadoentidad')); ?>:</b>
	<?php echo CHtml::encode($data->idestadoentidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_carga')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_carga); ?>
	<br />


</div>