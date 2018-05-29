<?php
/* @var $model UsrDeudasLotes */
/* @var $form CActiveForm */
?>

<div class="modal fade" id="modalImportar" tabindex="-1" role="dialog">
  <div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Cargar Deudas</h4>
      </div>
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
      <div class="modal-body">      
        <div class="row">
            <?php echo $form->labelEx($model,'filename'); ?>
            <?php echo $form->fileField($model,'filename',array(
                                                           'size'=>45,
                                                           'maxlength'=>45
            )); ?>
            <?php echo $form->error($model,'filename'); ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <?php echo CHtml::submitButton('Procesar',array('class'=>'btn btn-primary btn-procesar')); ?>
      </div>
      <?php $this->endWidget(); ?>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->	