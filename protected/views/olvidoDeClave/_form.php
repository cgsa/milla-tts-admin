<?php
/* @var $this OlvidoDeClaveController */
/* @var $model UsrUsuariosSistema */
/* @var $form CActiveForm */ 
?>
<div class="card card-login mx-auto mt-5">
  <div class="card-header">Recuperar Clave</div>
  <div class="card-body">
    <div class="text-center mt-4 mb-5">
      <h4>Olvido su clave?</h4>
      <p>Ingrese su email y se le enviara un correo con la instrucciones para establecer una clave nueva. </p>
    </div>
    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'pwdrcv-form',
    	'enableClientValidation'=>false,
    	'clientOptions'=>array(
    		'validateOnSubmit'=>true,
    	),
    )); ?>
      <div class="form-group">
        <?php echo $form->textField($model,'username',array("class"=>"form-control","id"=>"exampleInputEmail1","placeholder"=>"Ingrese su e-mail")); ?>
      </div>
      <?php if(CCaptcha::checkRequirements()): ?>
          <div class="form-group">
            <?php echo $form->labelEx($model,'verifyCode'); ?>
    		<div>
    			<?php $this->widget('CCaptcha'); ?>
    			<?php echo $form->textField($model,'verifyCode'); ?>
    		</div>
    		<div class="hint"><?php echo CrugeTranslator::t("por favor ingrese los caracteres o digitos que vea en la imagen");?></div>
    			<?php echo $form->error($model,'verifyCode'); ?>
          </div>
      <?php endif; ?>
      <a class="btn btn-primary btn-block btn-aceptar-recuperar" href="">Aceptar</a>
    <?php $this->endWidget(); ?>
    <div class="text-center">
      <a class="d-block small mt-3" href="<?php echo Yii::app()->createUrl("/registroNuevoUsuario/registro");?>">
      	Registrar Usuario
      </a>
      <a class="d-block small" href="<?php echo Yii::app()->createUrl("/site/login");?>">
      	Inicio
      </a>
    </div>
  </div>
</div>