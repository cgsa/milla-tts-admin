<?php
/* @var $model UsrDeudasLotes */
/* @var $form CActiveForm */
?>
<div class="modal-dialog" >
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usr_deudas_lotes-form',
    'action'=> Yii::app()->createUrl('PanelAdministrativo/CargarDeudas'),
    'method'=> 'post',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )); ?>
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Formulario Importador</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>        
      </div>
      <div class="modal-body" >  
      	 <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
            	<?php echo $form->labelEx($model,'filename'); ?>
                <?php echo $form->fileField($model,'filename',array(
                                                               'size'=>45,
                                                               'maxlength'=>45
                )); ?>
                <?php echo $form->error($model,'filename'); ?>
            </div>
        </div>	    	       
 	  </div>
      <div class="modal-footer">
     	  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <?php echo CHtml::submitButton('Procesar',array('class'=>'btn btn-primary btn-procesar')); ?>
      </div>
     </div>  
     <?php $this->endWidget(); ?>   
</div>