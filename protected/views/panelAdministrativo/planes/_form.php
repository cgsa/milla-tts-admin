<?php
/* @var $this UsrEntidadesController */
/* @var $model PlanesEntidad */
/* @var $form CActiveForm */
?>
<div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Formulario de Configuración</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>        
      </div>
      <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'planes_entidad_form',
        'action'=> "",
        'method'=> 'post',
    	// Please note: When you enable ajax validation, make sure the corresponding
    	// controller action is handling ajax validation correctly.
    	// There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array(),
        )); ?>
        <input type="hidden" id="id" name="id" value="<?php echo $model->id ?>">
        <input type="hidden" id="action" name="action" value="UP">
      <div class="modal-body">   
        <div class="row" >
        	<?php 
        	
        	$json = (!empty($model->config_json))? $model->config_json: "";
        	
        	if($json != ""):
        	?>
        		<?php
        		$array = json_decode($json);
        		//var_dump($json);die;
            	foreach($array->config as $key=>$value):
            	?>
            	<div class="form-group">
                    <div class="form-row">
                      <div class="col-md-12">        		
                		<label><?php echo ucwords($key);?></label>
                		<input class="form-control" autocomplete="off" name="config[<?php echo $key;?>]" value="<?php echo $value;?>" type="text">                  </div>
                    </div>
                </div>
                <?php 
                endforeach;
                ?>
        	<?php 
        	endif;
        	?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <?php echo CHtml::submitButton('Registrar',array('class'=>'btn btn-primary btn-procesar-datos')); ?>
      </div>
      <?php $this->endWidget(); ?>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->