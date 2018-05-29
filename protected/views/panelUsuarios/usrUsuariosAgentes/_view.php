<?php
/* @var $this UsrUsuariosAgentesController */
/* @var $data UsrUsuariosAgentes */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('identidad')); ?>:</b>
	<?php echo CHtml::encode($data->identidad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono_particular')); ?>:</b>
	<?php echo CHtml::encode($data->telefono_particular); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono_movil')); ?>:</b>
	<?php echo CHtml::encode($data->telefono_movil); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estadoagente')); ?>:</b>
	<?php echo CHtml::encode($data->estadoagente); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_carga')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_carga); ?>
	<br />


</div>