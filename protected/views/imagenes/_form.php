<?php
/* @var $this ImagenesController */
/* @var $model Imagenes */
/* @var $form CActiveForm */
?>
<div class="modal-dialog" >
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'imagenes-form',
    'action'=> '',
    'method'=> 'post',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array('class'=>'form-horizontal'),
    )); ?>
    <div class="modal-content">
          <div class="modal-header">
          	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Re-publicar Imagen</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
            <input type="hidden" id="hdd_action" name="action" value="">  
            <input type="hidden" name="id" value="<?php echo $id;?>">       
          </div>
          <div class="modal-body" >
            <div class="form-group">
                <?php echo $form->labelEx($model,'seleccion',array('class'=>'col-sm-3 control-label')); ?>
                <div class="col-sm-9">
                    <?php 
            		echo $form->dropDownList($model,'seleccion',array('B' => 'Banner','P' => 'Promociones'),
            		          array('empty' => '--Seleccione--','class'=>'form-control'));
            		?>
            		<?php echo $form->error($model,'seleccion'); ?>
                </div>
            </div>
     	  	<div id="banner_block" style="display: none;" >
            	<?php 
            	$this->renderPartial('_banner', array(
            	    'model'=>$banner,
            	    'form'=>$form
            	));
            	?>    	       
     	  	</div>
     	  	<div id="promociones_block" style="display: none;" >
            	<?php 
            	$this->renderPartial('_promociones', array(
            	    'model'=>$promo,
            	    'form'=>$form
            	));
            	?>    	       
     	  	</div>
            <div class="modal-footer">
              	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            	<?php echo CHtml::submitButton('Procesar',array('class'=>'btn btn-primary btn-procesar-datos')); ?>
            </div>
         </div> 
	</div> 
   	<?php $this->endWidget(); ?>  
</div>

