<?php
/* @var $this UsrEntidadesController */
/* @var $model UsrEntidades */
/* @var $form CActiveForm */
?>
<div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Formulario de Entidad</h4>
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
        <input type="hidden" id="id" name="id" value="<?php echo isset($id)? $id : ''; ?>">
        <input type="hidden" id="action" name="action" value="<?php echo isset($action)? $action : ''; ?>">
      <div class="modal-body">   
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <?php echo $form->labelEx($model,'idestadoentidad'); ?>
        		<?php 
        		      echo $form->dropDownList($model,'idestadoentidad',array('1' => 'Activo', '0' => 'Inactivo'),
        		          array('empty' => '--Seleccione--','class'=>'form-control'));
        		?>
        		<?php echo $form->error($model,'idestadoentidad'); ?>
        		
              </div>
              <div class="col-md-6">
                <?php echo $form->labelEx($model,'nombre_entidad'); ?>
        		<?php echo $form->textField($model,'nombre_entidad',array('size'=>50,'maxlength'=>50,'class'=>'form-control')); ?>
        		<?php echo $form->error($model,'nombre_entidad'); ?>
              </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">            	
                <div class="col-md-9">
                    <?php echo $form->labelEx($model,'filename'); ?>
                    <?php echo $form->fileField($model,'filename',array(
                                                                   'size'=>45,
                                                                   'maxlength'=>45
                    )); ?>
                    <?php echo $form->error($model,'filename'); ?>
                </div>
                <?php 
                    $img = Yii::app()->request->baseUrl .'/upload/img/'.$model->logo;
                    if($action == 'U'):
                ?>
                	<div class="col-md-3">
                		<img class="d-flex mr-3" width="45" height="45" src="<?php echo $img; ?>" alt="">
                	</div>
                <?php 
                    endif;
                ?>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <?php echo CHtml::submitButton('Registrar',array('class'=>'btn btn-primary btn-procesar-datos')); ?>
      </div>
      <?php $this->endWidget(); ?>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->