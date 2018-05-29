<?php
/* @var $this UsrUsuariosAgentesController */
/* @var $model UsrUsuariosAgentes */
/* @var $form CActiveForm */
?>

<div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Configurar Campos adicionales</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>        
      </div>
      <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'usr_etiquetas_campos_adicionales',
        'action'=> Yii::app()->createUrl('PanelAdministrativo/OperacionConfiguracion'),
        'method'=> 'post',
    	// Please note: When you enable ajax validation, make sure the corresponding
    	// controller action is handling ajax validation correctly.
    	// There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array(),
        )); ?>
        <input type="hidden" id="id" name="id" value="<?php echo $model->id; ?>">
        <input type="hidden" id="action" name="action" value="U">
      <div class="modal-body">
      	<div class="row" >
      		<div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">        		
            		<?php echo $form->labelEx($model,'adicional01'); ?>
            		<?php echo $form->textField($model,'adicional01',array('class'=>'form-control','autocomplete'=>'off')); ?>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">        		
            		<?php echo $form->labelEx($model,'adicional02'); ?>
            		<?php echo $form->textField($model,'adicional02',array('class'=>'form-control','autocomplete'=>'off')); ?>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">        		
            		<?php echo $form->labelEx($model,'adicional03'); ?>
            		<?php echo $form->textField($model,'adicional03',array('class'=>'form-control','autocomplete'=>'off')); ?>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">        		
            		<?php echo $form->labelEx($model,'adicional04'); ?>
            		<?php echo $form->textField($model,'adicional04',array('class'=>'form-control','autocomplete'=>'off')); ?>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">        		
            		<?php echo $form->labelEx($model,'adicional05'); ?>
            		<?php echo $form->textField($model,'adicional05',array('class'=>'form-control','autocomplete'=>'off')); ?>
                  </div>
                </div>
            </div>            
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <?php echo CHtml::submitButton('Registrar',array('class'=>'btn btn-primary btn-actualizar-etiquetas')); ?>
      </div>
      <?php $this->endWidget(); ?>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->