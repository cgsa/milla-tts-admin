<?php /* echo CrugeTranslator::t('logon',"Login"); ?><h1></h1>
<?php if(Yii::app()->user->hasFlash('loginflash')): ?>
<div class="flash-error">
	<?php echo Yii::app()->user->getFlash('loginflash'); ?>
</div>
<?php else: ?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'logon-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php Yii::app()->user->ui->tbutton(CrugeTranslator::t('logon', "Login")); ?>
		<?php echo Yii::app()->user->ui->passwordRecoveryLink; ?>
		<?php
			if(Yii::app()->user->um->getDefaultSystem()->getn('registrationonlogin')===1)
				echo Yii::app()->user->ui->registrationLink;
		?>
	</div>

	<?php
		//	si el componente CrugeConnector existe lo usa:
		//
		if(Yii::app()->getComponent('crugeconnector') != null){
		if(Yii::app()->crugeconnector->hasEnabledClients){ 
	?>
	<div class='crugeconnector'>
		<span><?php echo CrugeTranslator::t('logon', 'You also can login with');?>:</span>
		<ul>
		<?php 
			$cc = Yii::app()->crugeconnector;
			foreach($cc->enabledClients as $key=>$config){
				$image = CHtml::image($cc->getClientDefaultImage($key));
				echo "<li>".CHtml::link($image,
					$cc->getClientLoginUrl($key))."</li>";
			}
		?>
		</ul>
	</div>
	<?php }} ?>
	

<?php $this->endWidget(); ?>
</div>
<?php endif; */?>
<div class="card card-login mx-auto mt-5">
  <div class="card-header">Login</div>
  <div class="card-body">
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'logon-form',
    	'enableClientValidation'=>false,
    	'clientOptions'=>array(
    		'validateOnSubmit'=>true,
    	),
    )); ?>
      <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <?php echo $form->textField($model,'username',array('class'=>'form-control','id'=>'exampleInputEmail1')); ?>
		<?php echo $form->error($model,'username'); ?>
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <?php echo $form->passwordField($model,'password',array('class'=>'form-control','id'=>'exampleInputPassword1')); ?>
		<?php echo $form->error($model,'password'); ?>
      </div>
      <div class="form-group">
        <div class="form-check">
          <label class="form-check-label">
            <?php echo $form->checkBox($model,'rememberMe',array('class'=>'form-check-input')); ?>
             Remember Password</label>
        </div>
      </div>
      <input class="btn btn-primary btn-block" name="submit" type="submit" value="Login">
      <?php //Yii::app()->user->ui->tbutton(CrugeTranslator::t('logon', "Login",array('class'=>'btn btn-primary btn-block'))); ?>
    <?php $this->endWidget(); ?>
    <div class="text-center">
      <a class="d-block small mt-3" href="<?php echo Yii::app()->user->ui->registrationUrl;?>">Register an Account</a>
      <a class="d-block small" href="<?php echo Yii::app()->user->ui->passwordRecoveryUrl; ?>">Forgot Password?</a>
    </div>
  </div>
</div>
