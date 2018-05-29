<?php
/* @var $this PanelAdministrativoController */
/* @var $model PlanesEntidad */
/* @var $form CActiveForm */
?>
<div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Formulario de Activación</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>        
      </div>
      <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'planes_entidad_form',
        'action'=> Yii::app()->createUrl('PanelAdministrativo/Operacion'),
        'method'=> 'post',
    	// Please note: When you enable ajax validation, make sure the corresponding
    	// controller action is handling ajax validation correctly.
    	// There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        )); ?>
        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
        <?php echo $form->hiddenField($model, 'identidad', array('value'=>$id)); ?>
        <input type="hidden" id="action" name="action" value="IAP">
      <div class="modal-body">   
        <div class="row" >
        	<div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">        		
            		<?php echo $form->labelEx($model,'idherramienta'); ?>        		
        			<?php 
            		$list = CHtml::listData(Herramientas::model()->findAll(array('order' => 'nombre')),'id', 'nombre'); 
            		?> 
            		<?php 
            		echo $form->dropDownList($model,'idherramienta',$list,
            		          array('empty' => '--Seleccione--','class'=>'form-control'));
            		?>
                  </div>
                  <div class="col-md-6">
                    <?php echo $form->labelEx($model,'idplan'); ?>
            		<?php 
            		      echo $form->dropDownList($model,'idplan',array(),
            		          array('empty' => '--Seleccione--','class'=>'form-control'));
            		?>            		
                  </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row"> 
                    <div class="col-md-6">
                        <?php echo $form->labelEx($model,'fecha_ini'); ?>
                        <?php
                            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model' => $model,
                                'attribute' => 'fecha_ini',
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
                    </div> 
                </div>
            </div>
            <div class="form-group" id="div_config_json" style="display: none;">
                <div class="form-row">
                  <div class="col-md-12">        		
            		<?php echo $form->labelEx($model,'config_json'); ?>        		
        			<dl id="dl_body_config_json" >                
                    </dl>            		
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