<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#"><?php echo ucwords(CrugeTranslator::t("Panel de Usuarios"));?></a>
    </li>
    <li class="breadcrumb-item active"><?php echo ucwords(CrugeTranslator::t("eliminar usuario"));?></li>
</ol>
<div class="form">
<?php
	/*
		$model:  es una instancia que implementa a ICrugeStoredUser
	*/
?>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id'=>'crugestoreduser-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>false,
)); ?>
    <div class="form-group">
        <div class="form-row">
            <div class="col-md-12">
            	<h2><?php echo $model->username; ?>
                    <?php echo $model->email; ?>
                </h2>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-6">
        		<?php echo ucfirst(CrugeTranslator::t("marque la casilla para confirmar la eliminacion")); ?>
            	<?php echo $form->checkBox($model,'deleteConfirmation',array('class'=>'form-control')); ?>
            	<?php echo $form->error($model,'deleteConfirmation'); ?>   		
        	</div>
        	<div class="col-md-6"></div>
        </div>
        <div class="form-row">
        	<div class="col-md-4"></div>
            <div class="col-md-4">
            	<?php Yii::app()->user->ui->tbutton("Eliminar Usuario"); ?>
				<?php Yii::app()->user->ui->bbutton("Volver",'cancelar'); ?>
            </div>
            <div class="col-md-4"></div>
        </div>
        <div class="form-row">
        	<div class="col-md-12">
        		<?php echo $form->errorSummary($model); ?>
        	</div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>