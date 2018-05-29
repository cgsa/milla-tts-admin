<?php
/* @var $this UsrUsuariosAgentesController */
/* @var $model UsrUsuariosAgentes */
/* @var $form CActiveForm */
?>

<div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Formulario de Agentes</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>        
      </div>
      <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'usr_usuarios_agentes_form',
        'action'=> Yii::app()->createUrl('PanelAdministrativo/Operacion'),
        'method'=> 'post',
    	// Please note: When you enable ajax validation, make sure the corresponding
    	// controller action is handling ajax validation correctly.
    	// There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array(),
        )); ?>
        <input type="hidden" id="id" name="id" value="<?php echo isset($id)? $id : ''; ?>">
        <input type="hidden" id="action" name="action" value="<?php echo isset($action)? $action : ''; ?>">
      <div class="modal-body">
      	<div class="row" >
      		<?php 
          	if(isset($action) && $action == 'I'):
          	?>
          	<div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">        		
            		<?php echo $form->labelEx($model,'username'); ?>
            		<?php echo $form->textField($model,'username',array('class'=>'form-control','autocomplete'=>'off')); ?>
                  </div>
                  <div class="col-md-6">
                    <?php echo $form->labelEx($model,'email'); ?>
            		<?php echo $form->textField($model,'email',array('class'=>'form-control','autocomplete'=>'off')); ?>
                  </div>
                </div>
            </div>
          	<div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">        		
            		<?php echo $form->labelEx($model,'password'); ?>
            		<?php echo $form->passwordField($model,'password',array('class'=>'form-control','autocomplete'=>'off')); ?>
                  </div>
                </div>
            </div>  
            <?php 
            endif;
            ?>
            <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">
                  	<?php 
            		$list = CHtml::listData(UsrEntidades::model()->findAll(array('order' => 'nombre_entidad')),'id', 'nombre_entidad'); 
            		?>        		
            		<?php echo $form->labelEx($model,'identidad'); ?>
            		<?php 
            		echo $form->dropDownList($model,'identidad',$list,
            		          array('empty' => '--Seleccione--','class'=>'form-control'));
            		?>
                  </div>
                  <div class="col-md-6">
                    <?php echo $form->labelEx($model,'telefono_particular'); ?>
            		<?php
                        $this->widget('CMaskedTextField', array(
                        'model' => $model,
                        'attribute' => 'telefono_particular',
                        //'mask' => '+549-9999999999',
                        'mask'        => '+5nnnnnnnnnnnn',
                        'charMap'     => array('n' => '[0-9]'),
                        'htmlOptions' => array('size' => 45,'class'=>'form-control')
                        ));
                    ?>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                  <div class="col-md-6">        		
            		<?php echo $form->labelEx($model,'telefono_movil'); ?>
            		<?php
                        $this->widget('CMaskedTextField', array(
                        'model' => $model,
                        'attribute' => 'telefono_movil',
                        //'mask' => '+549-9999999999',
                        'mask'        => '+5nnnnnnnnnnnn',
                        'charMap'     => array('n' => '[0-9]'),
                        'htmlOptions' => array('size' => 45,'class'=>'form-control')
                        ));
                    ?>
                  </div>
                  <div class="col-md-6">
            		<?php echo $form->labelEx($model,'estadoagente'); ?>
            		<?php 
            		      echo $form->dropDownList($model,'estadoagente',array('1' => 'Activo', '0' => 'Inactivo'),
            		          array('empty' => '--Seleccione--','class'=>'form-control'));
            		?>
                  </div>
                </div>
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