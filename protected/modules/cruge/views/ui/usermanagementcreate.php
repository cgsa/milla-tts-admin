<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#"><?php echo ucwords(CrugeTranslator::t("Panel de Usuarios"));?></a>
    </li>
    <li class="breadcrumb-item active"><?php echo ucwords(CrugeTranslator::t("crear nuevo usuario"));?></li>
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
            <div class="col-md-6">
            	<?php echo $form->labelEx($model,'username'); ?>
        		<?php echo $form->textField($model,'username',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'username'); ?>
            </div>
            <div class="col-md-6">
        		<?php echo $form->labelEx($model,'email'); ?>
        		<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'email'); ?>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-12">
            	<?php echo $form->labelEx($model,'newPassword'); ?>
        		<?php echo $form->textField($model,'newPassword',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'newPassword'); ?>    		
        	</div>
        	<div class="col-md-6">
        		<script>
        			function fnSuccess(data){
        				$('#CrugeStoredUser_newPassword').val(data);
        			}
        			function fnError(e){
        				alert("error: "+e.responseText);
        			}
        		</script>
        		<?php echo CHtml::ajaxbutton(
        			CrugeTranslator::t("Generar una nueva clave")
        			,Yii::app()->user->ui->ajaxGenerateNewPasswordUrl
        			,array('success'=>'js:fnSuccess','error'=>'js:fnError')
        		); ?>
            </div>
        </div>
        <div class="form-row">
        	<div class="col-md-4"></div>
            <div class="col-md-4">
            	<?php Yii::app()->user->ui->tbutton("Crear Usuario"); ?>
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