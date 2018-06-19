<?php
/* @var $this PanelAdministrativoController */
/* @var $model Herramientas */
/* @var $form CActiveForm */
?>

<div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Formulario de Planes</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>        
      </div>
      <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'Planes_form',
        'action'=> Yii::app()->createUrl('PanelAdministrativo/Operacion'),
        'method'=> 'post',
    	// Please note: When you enable ajax validation, make sure the corresponding
    	// controller action is handling ajax validation correctly.
    	// There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
      'enableAjaxValidation' => false,
      //'htmlOptions' => array('enctype' => 'multipart/form-data'),
        )); ?>
        <input type="hidden" id="Planes_id" name="Planes[idherramienta]" value="<?php echo isset($id)? $id : ''; ?>">
        <input type="hidden" id="action" name="action" value="IP">
      <div class="modal-body">
      	<div class="row" >
      		<div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">        		
            		<?php echo $form->labelEx($model,'nombre'); ?>
            		<?php echo $form->textField($model,'nombre',array('class'=>'form-control','autocomplete'=>'off')); ?>
                  </div>
                  <div class="col-md-6">
                    <?php echo $form->labelEx($model,'idopcionpago'); ?>
            		<?php 
            		echo $form->dropDownList($model,'idopcionpago',array('1' => 'Sin Costo', '2' => 'Con Costo', '3' => 'Activación Temporal'),
            		          array('empty' => '--Seleccione--','class'=>'form-control'));
            		?>
                  </div>
                </div>
            </div>
      		<div class="form-group">
                <div class="form-row">
                  <div class="col-md-6"> 
                  	<?php 
                  	$valor = ($model->idopcionpago == 2 )? $model->costo: 0;
                  	$disabledCosto = ($model->idopcionpago == 2 )? "": "disabled";
                  	$disabledFecha = ($model->idopcionpago == 3 )? "": "disabled";
                  	?>       		
            		<?php echo $form->labelEx($model,'costo'); ?>
            		<?php echo $form->textField($model,'costo',array('class'=>'form-control','value'=>$valor,'disabled'=>$disabledCosto,'autocomplete'=>'off')); ?>
                  </div>
                  <div class="col-md-6">
                    <?php echo $form->labelEx($model,'fecha_desactivar'); ?>
                    <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $model,
                            'attribute' => 'fecha_desactivar',
                            'language' => 'es',
                            'options' => array(
                                'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"
                                'showOtherMonths' => true,      // show dates in other months
                                'selectOtherMonths' => true,    // can seelect dates in other months
                                'changeYear' => true,           // can change year
                                'changeMonth' => true,          // can change month
                                'yearRange' => '2000:2099',     // range of year
                                'minDate' => 'now',      // minimum date
                                'showButtonPanel' => false,      // show button panel
                            ),
                            'htmlOptions' => array(
                                'size' => '10',
                                'maxlength' => '10',
                                'class'=>'form-control',
                                'disabled'=>$disabledFecha
                            ),
                        ));
                    ?> 
                  </div>
                </div>
            </div>
      		<div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
                    <?php echo $form->labelEx($model,'descripcion'); ?>
            		<?php echo $form->textArea($model, 'descripcion', array('class'=>'form-control','maxlength' => 300,'rows'=>'5','placeholder' => 'Ingrese su mensaje')); ?>           		
                  </div>
                </div>
            </div>        	
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <?php echo CHtml::submitButton('Registrar',array('data-action'=>'LP','data-id'=>$id,'class'=>'btn btn-primary btn-procesar')); ?>
      </div>
      <?php $this->endWidget(); ?>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->