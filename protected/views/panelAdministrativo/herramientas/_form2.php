<?php
/* @var $this UsrEntidadesController */
/* @var $model UsrEntidades */
/* @var $form CActiveForm */
?>
<div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Formulario de Activación Chat</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>        
      </div>
      <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'usr_entidades_form',
        'action'=> Yii::app()->createUrl('PanelAdministrativo/Operacion'),
        'method'=> 'post',
    	// Please note: When you enable ajax validation, make sure the corresponding
    	// controller action is handling ajax validation correctly.
    	// There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
        )); ?>
        <input type="hidden" id="HerramientasEntidad_identidad" name="HerramientasEntidad[identidad]" value="<?php echo isset($id)? $id : ''; ?>">
        <input type="hidden" id="HerramientasEntidad_idherramienta" name="HerramientasEntidad[idherramienta]" value="1">
        <input type="hidden" id="id" name="id" value="<?php echo !empty($model->id)? $model->id : ''; ?>">
        <input type="hidden" id="action" name="action" value="<?php echo isset($aux)? $aux : ''; ?>">
      <div class="modal-body">   
        <div class="row" >
        	<div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">        		
            		<?php echo $form->labelEx($model,'codigo_url'); ?>
            		<?php echo $form->textField($model,'codigo_url',array('class'=>'form-control','placeholder'=>'cancelo','autocomplete'=>'off')); ?>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row"> 
                    <div class="col-md-6">
                        <?php echo $form->labelEx($model,'fecha_inicio'); ?>
                        <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $model,
                                'attribute' => 'fecha_inicio',
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
                                    'class'=>'form-control'
                                ),
                            ));
                        ?>                        
                        <?php echo $form->error($model,'fecha_inicio'); ?>
                    </div> 
                    <div class="col-md-6">
                        <?php echo $form->labelEx($model,'fecha_fin'); ?>
                        <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $model,
                                'attribute' => 'fecha_fin',
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
                                    'class'=>'form-control'
                                ),
                            ));
                        ?>                        
                        <?php echo $form->error($model,'fecha_fin'); ?>
                    </div> 
                </div>
            </div> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <?php echo CHtml::submitButton('Registrar',array('class'=>'btn btn-primary btn-procesar-datos2')); ?>
      </div>
      <?php $this->endWidget(); ?>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->