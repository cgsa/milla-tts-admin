<?php
/* @var $this PromocionesController */
/* @var $model Promociones */
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
		<?php echo $form->label($model,'id_lugar'); ?>
		<?php echo $form->textField($model,'id_lugar'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cant_millas'); ?>
		<?php echo $form->textField($model,'cant_millas',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cant_cuotas'); ?>
		<?php echo $form->textField($model,'cant_cuotas',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_vencimiento'); ?>
		<?php echo $form->textField($model,'fecha_vencimiento'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cant_pasajes'); ?>
		<?php echo $form->textField($model,'cant_pasajes'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'codigo_barra'); ?>
		<?php echo $form->textField($model,'codigo_barra',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_imagen'); ?>
		<?php echo $form->textField($model,'id_imagen'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'visibilidad'); ?>
		<?php echo $form->textField($model,'visibilidad'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_fin'); ?>
		<?php echo $form->textField($model,'fecha_fin'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'fecha_registro'); ?>
		<?php echo $form->textField($model,'fecha_registro'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->