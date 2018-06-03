<?php
/* @var $this UsrMensajesController */
/* @var $model UsrMensajes */
/* @var $form CActiveForm */
Yii::import('ext.imperavi-redactor.ImperaviRedactorWidget');
?>

<div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Formulario de Mensajes</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>        
      </div>
      <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'usr_mensajes_form',
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
        <?php 
      	if(isset($action) && $action == 'UU'):
      	?>  
        <input type="hidden" name="UsrMensajes[identidad]" value="<?php echo $model->identidad;?>"/>
        	<?php 
        endif;
        ?>
        <input type="hidden" name="UsrMensajes[rfc_cliente]" value="<?php echo Yii::app()->user->getState('rfc')?>"/>
      <div class="modal-body">
        <?php 
      	if(isset($action) && $action == 'IU'):
      	?>   	
      	<div class="form-group">
            <div class="form-row">
              <div class="col-md-12">        		
        		<select name="UsrMensajes[identidad]" class="form-control" >
        			<option value="">--Seleccione--</option>
        			<?php 
        			$rows = $model->getDeudasActivas();
        			foreach ($rows as $key=>$value):
        			     $entidad = $model->getInfoEntidad($value->identidad);
        			?>
        				<option value="<?php echo $entidad->id;?>"><?php echo $entidad->nombre_entidad;?></option>
        			<?php
        			endforeach;?>
        		</select>
              </div>
            </div>
        </div>
        <?php 
        endif;
        ?>     	
      	<div class="form-group">
            <div class="form-row">
              <div class="col-md-12">        		
        		<?php 
        		$readonly = "";
        		$direction = "BW:";
        		if($action != 'IU')
        		{
        		    $readonly = "readonly";
        		    $model->asunto = ($model->estadomensaje == 2)? $direction.$model->asunto : $model->asunto;
        		}
        		
        		echo $form->labelEx($model,'asunto'); ?>
				<?php echo $form->textField($model,'asunto',array('maxlength'=>255,'size' => 45,'readonly'=>$readonly,'class'=>'form-control')); ?>
              </div>
            </div>
        </div>
        <?php 
      	if(isset($action) && $action == 'UU'):
      	?>
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">           		
        		<textarea class="form-control" rows="5" id="mensajeanterior" disabled="disabled" ><?php echo strip_tags($model->mensaje);?></textarea>
              </div>
            </div>
        </div>
        <?php 
        endif;
        ?>  
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">        		
        		<?php 
        		$this->widget('ImperaviRedactorWidget', array(
        		    'model' => $model,
        		    'attribute' => 'mensaje',
        		    'options' => array(
        		        'focus' => true,
        		        'lang' => Yii::app()->language,
        		        'buttons' => array('html', 'bold', 'deleted', 'unorderedlist', 'orderedlist', 'link'),
        		    ),
        		    'htmlOptions' => array('placeholder' => 'Ingrese su mensaje')
        		));
        		?>
        		
        		
              </div>
            </div>
        </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <?php echo CHtml::submitButton('Responder',array('class'=>'btn btn-primary btn-procesar-datos')); ?>
      </div>
      <?php $this->endWidget(); ?>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

