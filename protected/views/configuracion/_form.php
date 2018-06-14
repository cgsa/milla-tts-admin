<?php
/* @var $this ConfiguracionController */
/* @var $model Configuracion */
/* @var $form CActiveForm */
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/assets/8c8cd6f4/jquery.maskedinput.min.js", CClientScript::POS_END);
Yii::app()->clientScript->registerScript('configuracion', "

    jQuery.mask.definitions={'n':'\x5B0\x2D9\x5D'};
    jQuery('#Configuracion_valor_millas').mask('n.nnn,nn');
");
//$model->isNewRecord
?>

<!-- Start Row -->  
<div class="row">
	<!-- Horizontal form -->
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'banner-form',
                    'action'=> '',
                    'method'=> 'post',
                	// Please note: When you enable ajax validation, make sure the corresponding
                	// controller action is handling ajax validation correctly.
                	// There is a call to performAjaxValidation() commented in generated controller code.
                	// See class documentation of CActiveForm for details on this.
                    'enableAjaxValidation'=>false,
                    'htmlOptions' => array('class'=>'form-horizontal'),
                )); ?>                
                	
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'cod_empresa',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model,'cod_empresa',array('class'=>'form-control','size'=>60,'maxlength'=>15)); ?>
							<?php echo $form->error($model,'cod_empresa'); ?>
                        </div>
                    </div>  
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'cod_subempresa',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model,'cod_subempresa',array('class'=>'form-control','size'=>60,'maxlength'=>15)); ?>
							<?php echo $form->error($model,'cod_subempresa'); ?>
                        </div>
                    </div>   
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'verificador',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model,'verificador',array('class'=>'form-control','size'=>60,'maxlength'=>2)); ?>
							<?php echo $form->error($model,'verificador'); ?>
                        </div>
                    </div>    
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'valor_millas',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model,'valor_millas',array('class'=>'form-control','size'=>60,'maxlength'=>8)); ?>                            
							<?php echo $form->error($model,'valor_millas'); ?>
                        </div>
                    </div>
                    <div class="form-group m-b-0">
                        <div class="col-sm-offset-3 col-sm-9">
                        	<button type="submit" class="btn btn-info waves-effect waves-light">Registrar</button>
                        </div>
                    </div>
                <?php $this->endWidget(); ?>
            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- col -->
</div>
<!-- End Row -->






