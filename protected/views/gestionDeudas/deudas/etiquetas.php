<div class="row" >

	<div class="panel panel-primary">

        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6 col-xs-12">

                    <div class="m-t-20">
                        <?php $form=$this->beginWidget('CActiveForm', array(
                    	'id'=>'usr_etiquetas_campos_adicionales',
                        'action'=> Yii::app()->createUrl('GestionDeudas/etiquetas'),
                        'method'=> 'post',
                    	// Please note: When you enable ajax validation, make sure the corresponding
                    	// controller action is handling ajax validation correctly.
                    	// There is a call to performAjaxValidation() commented in generated controller code.
                        // See class documentation of CActiveForm for details on this.
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array(),
                        )); ?>
                        <input type="hidden" name="EtiquetasCamposAdicionales[id]" value="<?php echo $model->id; ?>">
                            <div class="form-group">
                                <?php echo $form->labelEx($model,'adicional01'); ?>
                        		<?php echo $form->textField($model,'adicional01',array('class'=>'form-control','autocomplete'=>'off')); ?>
                            </div>
            
                            <div class="form-group">
                                <?php echo $form->labelEx($model,'adicional02'); ?>
                        		<?php echo $form->textField($model,'adicional02',array('class'=>'form-control','autocomplete'=>'off')); ?>
                            </div>
            
                            <div class="form-group">
                                <?php echo $form->labelEx($model,'adicional03'); ?>
                        		<?php echo $form->textField($model,'adicional03',array('class'=>'form-control','autocomplete'=>'off')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($model,'adicional04'); ?>
                        		<?php echo $form->textField($model,'adicional04',array('class'=>'form-control','autocomplete'=>'off')); ?>
                            </div>
                            <div class="form-group">
                                <?php echo $form->labelEx($model,'adicional05'); ?>
                        		<?php echo $form->textField($model,'adicional05',array('class'=>'form-control','autocomplete'=>'off')); ?>
                            </div>
                            <div class="form-group">
                                <div>
                                    <?php echo CHtml::submitButton('Registrar',array('class'=>'btn btn-primary')); ?>                        
                                </div>
                            </div>
                        <?php $this->endWidget(); ?>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>

</div>