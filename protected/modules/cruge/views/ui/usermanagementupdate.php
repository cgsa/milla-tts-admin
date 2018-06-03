<?php
	/*
		$model:  
			es una instancia que implementa a ICrugeStoredUser, y debe traer ya los campos extra 	accesibles desde $model->getFields()
		
		$boolIsUserManagement: 
			true o false.  si es true indica que esta operandose bajo el action de adminstracion de usuarios, si es false indica que se esta operando bajo 'editar tu perfil'
	*/
?>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#"><?php echo ucwords(CrugeTranslator::t("Panel de Usuarios"));?></a>
    </li>
    <li class="breadcrumb-item active">
        <?php echo ucwords(CrugeTranslator::t(	
        	$boolIsUserManagement ? "editando usuario" : "editando tu perfil"
        ));?>
	</li>
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
        </div>
        <div class="form-row">
            <div class="col-md-12">
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
            <div class="col-md-4">
            	<?php echo $form->labelEx($model,'regdate'); ?>
    			<?php echo $form->textField($model,'regdate'
    					,array(
    					    'readonly'=>'readonly','class'=>'form-control',
    						'value'=>Yii::app()->user->ui->formatDate($model->regdate),
    					)
    			); ?>
            </div>
        	<div class="col-md-4">
			<?php echo $form->labelEx($model,'actdate'); ?>
			<?php echo $form->textField($model,'actdate'
					,array(
					    'readonly'=>'readonly','class'=>'form-control',
						'value'=>Yii::app()->user->ui->formatDate($model->actdate),
					)
				); ?>
        	</div>
            <div class="col-md-4">
			<?php echo $form->labelEx($model,'logondate'); ?>
			<?php echo $form->textField($model,'logondate'
					,array(
					    'readonly'=>'readonly','class'=>'form-control',
						'value'=>Yii::app()->user->ui->formatDate($model->logondate),
					)
				); ?>
            </div>
        </div>
        <div class="form-row">
        	<div class="col-md-4">
        		<!-- inicio de campos extra definidos por el administrador del sistema -->
                <?php 
                	if(count($model->getFields()) > 0){
                		echo "<div class='row form-group'>";
                		echo "<h6>".ucfirst(CrugeTranslator::t("perfil"))."</h6>";
                		foreach($model->getFields() as $f){
                			// aqui $f es una instancia que implementa a: ICrugeField
                			echo "<div class='col'>";
                			echo Yii::app()->user->um->getLabelField($f);
                			echo Yii::app()->user->um->getInputField($model,$f);
                			echo $form->error($model,$f->fieldname);
                			echo "</div>";
                		}
                		echo "</div>";
                	}
                ?>
        	</div>
        </div>
        <div class="form-row">
        	<div class="col-md-12">
        		<!-- inicio de opciones avanazadas, solo accesible bajo el rol 'admin' -->
        		
        		<?php 
                	if($boolIsUserManagement)
                	if(Yii::app()->user->checkAccess('edit-advanced-profile-features'
                		,__FILE__." linea ".__LINE__))
                		$this->renderPartial('_edit-advanced-profile-features'
                			,array('model'=>$model,'form'=>$form),false); 
                ?>
                
                <!-- fin de opciones avanazadas, solo accesible bajo el rol 'admin' -->
        	</div>
        </div>
        <div class="form-row">
        	<div class="col-md-4"></div>
            <div class="col-md-4">
            	<?php Yii::app()->user->ui->tbutton("Guardar Cambios"); ?>
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
