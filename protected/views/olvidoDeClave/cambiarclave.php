<?php
/* @var $this OlvidoDeClaveController */
/* @var $model UsrUsuariosSistema */
/* @var $form CActiveForm */ 
?>
<div class="card card-login mx-auto mt-5">
  <div class="card-header">Cambiar Clave</div>
  	<div class="card-body">
        <div class="text-center mt-4 mb-5">
          <p>Ingrese su nueva clave para completar la acción</p>
        </div>
        <?php $form=$this->beginWidget('CActiveForm', array(
        	'id'=>'usr-usuarios-sistema-form',
        	'enableClientValidation'=>false,
        	'clientOptions'=>array(
        		'validateOnSubmit'=>true,
        	),
        )); ?>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-5">
                <?php echo $form->labelEx($model,'pass'); ?>       	
              </div>
              <div class="col-md-7">
              	<?php echo $form->passwordField($model,'pass',
              	    array('size'=>50,'maxlength'=>50,'class'=>'form-control','id'=>'exampleInputPassword',"placeholder"=>"Ingrese su clave")); ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-5">
                <?php echo $form->labelEx($model,'pass2'); ?>
              </div>
              <div class="col-md-7">
              	<?php echo $form->passwordField($model,'pass2',
              	    array('size'=>50,'maxlength'=>50,'class'=>'form-control','id'=>'exampleConfirmPassword1',"placeholder"=>"Repita su clave")); ?>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">
                <a class="btn btn-primary btn-block btn-aceptar-recuperar" href="">Aceptar</a>
              </div>
            </div>
          </div>      
        <?php $this->endWidget(); ?>  
	</div>
</div>