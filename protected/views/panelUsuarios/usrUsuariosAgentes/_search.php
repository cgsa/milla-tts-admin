<?php
/* @var $this UsrUsuariosAgentesController */
/* @var $model UsrUsuariosAgentes */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'identidad'); ?>
		<?php echo $form->textField($model,'identidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefono_particular'); ?>
		<?php echo $form->textField($model,'telefono_particular',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefono_movil'); ?>
		<?php echo $form->textField($model,'telefono_movil',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estadoagente'); ?>
		<?php echo $form->textField($model,'estadoagente'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_carga'); ?>
		<?php echo $form->textField($model,'fecha_carga'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->