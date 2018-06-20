<?php
/* @var $this PromocionUsuarioController */
/* @var $model PromocionUsuario */
/* @var $form CActiveForm */
?>

<div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Formulario Cupones</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>        
      </div>
      <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'pagos_promociones_form',
        'action'=> '',
        'method'=> 'post',
    	// Please note: When you enable ajax validation, make sure the corresponding
    	// controller action is handling ajax validation correctly.
    	// There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
      'enableAjaxValidation' => false,
      'htmlOptions' => array(),
        )); ?>
        <input type="hidden" id="id" name="id" value="<?php echo isset($id)? $id : ''; ?>">
        <input type="hidden" id="action" name="action" value="<?php echo isset($action)? $action : ''; ?>">
      <div class="modal-body">
      	<div class="row" >
      		<div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">        		
            		<?php echo $form->labelEx($model,'cod_pago'); ?>
            		<?php echo $form->textField($model,'cod_pago',array('class'=>'form-control','autocomplete'=>'off')); ?>
                  </div>
                  <div class="col-md-12">        		
            		<?php echo $form->labelEx($model,'reference_id'); ?>
            		<?php echo $form->textField($model,'reference_id',array('class'=>'form-control','autocomplete'=>'off')); ?>
                  </div>
                  <div class="col-md-12">
                    <?php echo $form->labelEx($model,'status'); ?>
            		<?php 
        		      echo $form->dropDownList($model,'status',
        		          array('0' => 'Pendiente', '1' => 'Pago',
        		          '2' => 'Con problema'
        		      ),
        		      array('empty' => '--Seleccione--','class'=>'form-control'));
            		?> 
                  </div>
                </div>
            </div>         	
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <?php echo CHtml::submitButton('Registrar',array('class'=>'btn btn-primary btn-procesar-datos')); ?>
      </div>
      <?php $this->endWidget(); ?>
	</div>     
</div>
      