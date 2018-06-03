<?php
/* @var $this RegistroNuevoUsuarioController */
/* @var $model UsrUsuariosSistema */
/* @var $form CActiveForm */ 
?>
<div class="card card-register mx-auto mt-5">
  <div class="card-header">Registro de Usuario</div>
  <div class="card-body">
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'usr-usuarios-sistema-form',
    	// Please note: When you enable ajax validation, make sure the corresponding
    	// controller action is handling ajax validation correctly.
    	// There is a call to performAjaxValidation() commented in generated controller code.
    	// See class documentation of CActiveForm for details on this.
    	'enableAjaxValidation'=>false,
    )); ?>
      <div class="form-group">
        <div class="form-row">
          <div class="col-md-6">
            <?php echo $form->labelEx($model,'rfc'); ?>
        	<?php echo $form->textField($model,'rfc',array('size'=>50,'maxlength'=>50,'class'=>'form-control','id'=>'rfcName')); ?>
        	<?php echo $form->error($model,'rfc'); ?>
          </div>
          <div class="col-md-6">
            <?php echo $form->labelEx($model,'nombre'); ?>
        	<?php echo $form->textField($model,'nombre',array('size'=>50,'maxlength'=>50,'class'=>'form-control','id'=>'inputName')); ?>
        	<?php echo $form->error($model,'nombre'); ?>
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="form-row">
          <div class="col-md-6">
            <?php echo $form->labelEx($model,'apellido'); ?>
        	<?php echo $form->textField($model,'apellido',array('size'=>50,'maxlength'=>50,'class'=>'form-control','id'=>'inputLastName')); ?>
        	<?php echo $form->error($model,'apellido'); ?>
          </div>
          <div class="col-md-6">
            <?php echo $form->labelEx($model,'fecha_nacimiento'); ?>
        	<?php //echo $form->textField($model,'fecha_nacimiento',array('size'=>50,'maxlength'=>50,'class'=>'form-control','id'=>'exampleInputLastName')); ?>
        	<?php 
        	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
        	    'model' => $model,
        	    'attribute' => 'fecha_nacimiento',
        	    'language' => 'es',
        	    'options' => array(
        	        'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"
        	        'showOtherMonths' => true,      // show dates in other months
        	        'selectOtherMonths' => true,    // can seelect dates in other months
        	        'changeYear' => true,           // can change year
        	        'changeMonth' => true,          // can change month
        	        //'yearRange' => '2000:2099',     // range of year
        	        //'minDate' => '2000-01-01',      // minimum date
        	        'maxDate' => '-15y',      // maximum date
        	        'showButtonPanel' => true,      // show button panel
        	    ),
        	    'htmlOptions' => array(
        	        'size' => '30',         // textField size
        	        'maxlength' => '10',    // textField maxlength
        	        'class' => 'form-control',
        	    ),
        	));
        	?>
        	<?php echo $form->error($model,'fecha_nacimiento'); ?>
          </div>
        </div>
      </div>      
      <div class="form-group">
        <?php echo $form->labelEx($model,'mail'); ?>
    	<?php echo $form->textField($model,'mail',array('size'=>50,'maxlength'=>50,'class'=>'form-control','id'=>'exampleInputEmail1')); ?>
    	<?php echo $form->error($model,'mail'); ?>
      </div>          
      <div class="form-group">
        <div class="form-row">
          <div class="col-md-6">
            <?php echo $form->labelEx($model,'pass'); ?>
        	<?php echo $form->passwordField($model,'pass',array('size'=>50,'maxlength'=>50,'class'=>'form-control','id'=>'exampleInputPassword1')); ?>
        	<?php echo $form->error($model,'pass'); ?>
          </div>
          <div class="col-md-6">
            <?php echo $form->labelEx($model,'pass2'); ?>
        	<?php echo $form->passwordField($model,'pass2',array('size'=>50,'maxlength'=>50,'class'=>'form-control','id'=>'exampleConfirmPassword')); ?>
        	<?php echo $form->error($model,'pass2'); ?>
          </div>
        </div>
      </div>
      <?php echo CHtml::submitButton('Registrar',array('class'=>'btn btn-primary btn-block','id'=>'btn_registrar_new_usuario')); ?>
    <?php $this->endWidget(); ?>
    <div class="text-center">
      <a class="d-block small mt-3" href="<?php echo Yii::app()->createUrl("/site/login");?>">Inicio</a>
      <a class="d-block small" href="<?php echo Yii::app()->createUrl("/OlvidoDeClave/index");?>">Olvido de Clave?</a>
    </div>
  </div>
</div>