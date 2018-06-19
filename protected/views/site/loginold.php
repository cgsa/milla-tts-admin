<div class="card card-login mx-auto mt-5">
  <div class="card-header">¡Hola! ingresa tu e-mail</div>
  <div class="card-body">
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'logon-form',
    	'enableClientValidation'=>false,
    	'clientOptions'=>array(
    		'validateOnSubmit'=>true,
    	),
    )); ?>
      <div class="form-group">
        <label for="exampleInputEmail1" >Email</label>
        <?php echo $form->textField($model,'username',array('class'=>'form-control','id'=>'exampleInputEmail1')); ?>
		<?php echo $form->error($model,'username'); ?>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Clave</label>
        <?php echo $form->passwordField($model,'password',array('class'=>'form-control','id'=>'exampleInputPassword1')); ?>
		<?php echo $form->error($model,'password'); ?>
      </div>
      <input class="btn btn-primary btn-block" name="submit" type="submit" value="Login">
      <?php //Yii::app()->user->ui->tbutton(CrugeTranslator::t('logon', "Login",array('class'=>'btn btn-primary btn-block'))); ?>
    <?php $this->endWidget(); ?>
  </div>