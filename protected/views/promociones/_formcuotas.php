<?php
/* @var $this CuotasPromocionController */
/* @var $model CuotasPromocion */
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
      	<?php 
        if( $action == "IC" ):
        ?>
        	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Nueva Cuota</h4>
        <?php 
        elseif ($action == "UC"):
        ?>
        	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Actualizar Cuota</h4>
        <?php 
        endif;
        ?>
      	
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
        <input type="hidden" name="action" value="<?php echo $action;?>"> 
        <?php 
        if( $action == "IC" ):
        ?>
        <input type="hidden" name="CuotasPromocion[id_promocion]" value="<?php echo $id;?>"> 
        <?php 
        elseif ($action == "UC"):
        ?>
        	<input type="hidden" name="CuotasPromocion[id_promocion]" value="<?php echo $model->id_promocion;?>"> 
        	<input type="hidden" name="id" value="<?php echo $id;?>"> 
        <?php 
        endif;
        ?>
              
      </div>
      <div class="modal-body" >  
      	 <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
            	<?php echo $form->labelEx($model,'cant_cuotas'); ?>
				<?php echo $form->textField($model,'cant_cuotas',array('size'=>30,'maxlength'=>6,'class'=>'form-control')); ?>
                <?php echo $form->error($model,'cant_cuotas'); ?>
            </div>
        </div> 
      	 <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
            	<?php echo $form->labelEx($model,'cant_millas'); ?>
				<?php echo $form->textField($model,'cant_millas',array('size'=>30,'maxlength'=>6,'class'=>'form-control')); ?>
                <?php echo $form->error($model,'cant_millas'); ?>
            </div>
        </div>
      	 <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-10">
            	<?php echo $form->labelEx($model,'fecha_activa'); ?>
				<?php echo $form->textField($model,'fecha_activa',array('size'=>30,'maxlength'=>10,'class'=>'form-control')); ?>
                <?php echo $form->error($model,'fecha_activa'); ?>
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



