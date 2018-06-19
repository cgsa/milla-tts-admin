<?php
/* @var $this OlvidoDeClaveController */
/* @var $model UsrUsuariosSistema */
/* @var $form CActiveForm */ 
?>
<div class="card card-login mx-auto mt-5">
  <div class="card-header">Registro de Usuario</div>
  <div class="card-body">
      <div class="form-group">
    	<?php 
    	if(!$error):?>
			<div class="alert alert-primary" role="alert"><?php echo $mensaje;?></div>
		<?php 
		else:?>
			<div class="alert alert-success" role="alert"><?php echo $mensaje;?></div>
		<?php 
		endif;?>
      </div>
    <div class="text-center">
      <a class="d-block small" href="<?php echo Yii::app()->createUrl("/site/login");?>">
      	Inicio
      </a>
    </div>
  </div>
</div>