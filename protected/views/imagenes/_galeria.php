<?php
/* @var $this ImagenesController */
/* @var $model Galerias */
/* @var $form CActiveForm */
$baseUrl = Yii::app()->request->baseUrl;
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
    'htmlOptions' => array(),
    )); ?>
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Galeria de Imagenes</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
        <input type="hidden" name="action" value="<?php echo $action;?>">        
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
        <div class="row m-t-30" >
    		<?php 
      	
          	$criteria=new CDbCriteria;
          	$criteria->order = "id DESC";          	
          	$criteria->addInCondition('id',$ids); 
          	$rows = $imagen->findAll($criteria);
          	foreach ($rows as $key =>$value): 
          	?>
              	<div class="col-md-3 text-center" >
              		<div class="col-md-12" style="height: 150px;">
              			<img width="60%" src="<?php echo $baseUrl."/upload/img/".$value->path;?>" />
              			<input value="<?php echo $value->id;?>" type="hidden" name="imagenes[]" class="chk_imagenes" />
              		</div>
                </div>
			<?php 				
			endforeach;
			?>
    	</div>	    	       
 	  </div>
      <div class="modal-footer">
     	  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <?php echo CHtml::submitButton('Procesar',array('class'=>'btn btn-primary btn-procesar-datos')); ?>
      </div>
     </div>  
     <?php $this->endWidget(); ?>   
</div>



