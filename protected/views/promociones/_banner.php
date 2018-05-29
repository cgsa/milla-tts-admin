<?php
/* @var $this ImagenesController */
/* @var $model Imagenes */
/* @var $form CActiveForm */
?>
<div class="modal-dialog" >
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'formulario-form',
    'action'=> '',
    'method'=> 'post',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array(),
    )); ?>
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Complete los datos del Banner</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
        <input type="hidden" name="action" value="<?php echo $action;?>"> 
        <input type="hidden" name="Banner[id_imagen]" value="<?php echo $id;?>"> 
        <input type="hidden" name="id" value="<?php echo $promocion;?>">       
      </div>
      <div class="modal-body" >  
      	 <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
            	<?php echo $form->labelEx($model,'nombre'); ?>
				<?php echo $form->textField($model,'nombre',array('size'=>30,'maxlength'=>30,'class'=>'form-control')); ?>
                <?php echo $form->error($model,'nombre'); ?>
            </div>
        </div>
      	 <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
            	<?php echo $form->labelEx($model,'descripcion'); ?>
				<?php echo $form->textArea($model,'descripcion',array('class'=>'form-control wysihtml5','rows'=>9)); ?>
                <?php echo $form->error($model,'descripcion'); ?>
            </div>
        </div>
      	 <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
            	<?php echo $form->labelEx($model,'status'); ?>
            	<?php 
        		echo $form->dropDownList($model,'status',array('1' => 'Activo', '0' => 'Inactivo'),
        		          array('empty' => '--Seleccione--','class'=>'form-control'));
        		?>
        		<?php echo $form->error($model,'status'); ?>
            </div>
        </div>
        	    	       
 	  </div>
      <div class="modal-footer">
     	  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <?php echo CHtml::submitButton('Procesar',array('class'=>'btn btn-primary btn-procesar-formulario')); ?>
      </div>
     </div>  
     <?php $this->endWidget(); ?>   
</div>



