<?php
/* @var $this UsrMensajesController */
/* @var $model UsrMensajes */
/* @var $form CActiveForm */
$usuario = $model->getInfoUsuario($model->rfc_cliente);
$responder = !empty($model->respuesta)? false : true;
$mensajeLlamada = (Yii::app()->user->isSuperAdmin || Yii::app()->user->checkAccess('USER-CANCELO'))? true : false;
?>

<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Formulario Mensajes</h4>
        </div>
        <div class="modal-body">
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
          <div class="modal-body">
          	<?php 
          	if(isset($action) && $action == 'I'):
          	?>
          	<div class="form-group">
                <div class="form-row">
                  <?php 
                  if(Yii::app()->user->isSuperAdmin):
                  ?>
                  <div class="col-md-6">        		
            		<?php echo $form->labelEx($model,'identidad'); ?>        		
    				<?php 
            		$list = CHtml::listData(UsrEntidades::model()->findAll(array('order' => 'nombre_entidad')),'id', 'nombre_entidad'); 
            		?> 
            		<?php 
            		echo $form->dropDownList($model,'identidad',$list,
            		          array('empty' => '--Seleccione--','class'=>'form-control'));
            		?>
                  </div>
                  <?php 
                  elseif(Yii::app()->user->hasState('entidad')):
                  ?>
                  	<input type="hidden" name="UsrMensajes[identidad]" value="<?php echo Yii::app()->user->getState('entidad')?>"/>
                  <?php 
                  endif;
                  ?>
                  <div class="col-md-6">      		
            		<?php 
            		$criteria=new CDbCriteria;
            		$criteria->condition = "identidad = 15";
            		$criteria->order = "nombre_cliente ASC";
            		$list = CHtml::listData(UsrDeudas::model()->findAll($criteria),'rfc_cliente', 'nombre_cliente'); 
            		?> 
            		<?php 
            		echo $form->dropDownList($model,'rfc_cliente',$list,
            		          array('empty' => '--Seleccione el cliente--','class'=>'form-control'));
            		?>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">        		
    				<?php echo $form->textField($model,'asunto',array('maxlength'=>255,'size' => 45,'class'=>'form-control','placeholder' => 'Asunto')); ?>
                  </div>
                </div>
            </div> 
            <?php 
            endif;
            ?>      	 
            <?php 
            if($action == "I"):
            ?>
            	<div class="form-group">
                    <div class="form-row">
                      <div class="col-md-12">        		
                		<?php echo $form->textArea($model, 'mensaje', array('class'=>'form-control','maxlength' => 300,'rows'=>'5','placeholder' => 'Ingrese su mensaje')); ?>       		
                      </div>
                    </div>
                </div>
            <?php 
            else:
            ?> 
            	<div class="form-group">
            		<dl class="row" >
                        <dt class="col-sm-4">Usuario:</dt>
                        <dd class="col-sm-8"><?php echo $usuario->nombre_cliente;?></dd>
                        <dt class="col-sm-4">Asunto:</dt>
                        <dd class="col-sm-8"><?php echo $model->asunto;?></dd>
                        <dt class="col-sm-4">Pregunta:</dt>
                        <dd class="col-sm-8"><?php echo $model->mensaje;?></dd>
                        <?php 
                        if(!$responder):?>
                        	<dt class="col-sm-4">Respuesta:</dt>
                        	<dd class="col-sm-8"><?php echo $model->respuesta;?></dd>
                        <?php 
                        endif;?>
                    </dl>
            	</div>
            	<?php 
            	if($responder && !$mensajeLlamada):?>
                	<div class="form-group">
                        <div class="form-row">
                          <div class="col-md-12">        		
                    		<?php echo $form->textArea($model, 'respuesta', array('class'=>'form-control','maxlength' => 300,'rows'=>'5','placeholder' => 'Ingrese su mensaje')); ?>       		
                          </div>
                        </div>
                    </div>
                <?php 
                endif;?>
            <?php 
            endif;
            ?>      
          </div>
          <div class="modal-footer">
          	<?php 
          	if(!$mensajeLlamada):?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <?php 
                if($responder):?>
                	<?php echo CHtml::submitButton('Enviar',array('class'=>'btn btn-primary btn-procesar-datos')); ?>
                <?php 
                else:?>
                	<a href="#" class="btn btn-success btn_new_message" id="btn_nueva_entidad" data-id="false" data-action="I" title="Nueva Entidad" >
                  		Nuevo Mensajes
                  	</a>
                <?php 
                endif;?>
         	<?php 
         	endif;?>
          </div>
          <?php $this->endWidget(); ?>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default"
                    data-dismiss="modal">Close
            </button>
            <button type="button" class="btn btn-primary">Save changes
            </button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

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
      <div class="modal-body">
      	<?php 
      	if(isset($action) && $action == 'I'):
      	?>
      	<div class="form-group">
            <div class="form-row">
              <?php 
              if(Yii::app()->user->isSuperAdmin):
              ?>
              <div class="col-md-6">        		
        		<?php echo $form->labelEx($model,'identidad'); ?>        		
				<?php 
        		$list = CHtml::listData(UsrEntidades::model()->findAll(array('order' => 'nombre_entidad')),'id', 'nombre_entidad'); 
        		?> 
        		<?php 
        		echo $form->dropDownList($model,'identidad',$list,
        		          array('empty' => '--Seleccione--','class'=>'form-control'));
        		?>
              </div>
              <?php 
              elseif(Yii::app()->user->hasState('entidad')):
              ?>
              	<input type="hidden" name="UsrMensajes[identidad]" value="<?php echo Yii::app()->user->getState('entidad')?>"/>
              <?php 
              endif;
              ?>
              <div class="col-md-6">      		
        		<?php 
        		$criteria=new CDbCriteria;
        		$criteria->condition = "identidad = 15";
        		$criteria->order = "nombre_cliente ASC";
        		$list = CHtml::listData(UsrDeudas::model()->findAll($criteria),'rfc_cliente', 'nombre_cliente'); 
        		?> 
        		<?php 
        		echo $form->dropDownList($model,'rfc_cliente',$list,
        		          array('empty' => '--Seleccione el cliente--','class'=>'form-control'));
        		?>
              </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-row">
              <div class="col-md-12">        		
				<?php echo $form->textField($model,'asunto',array('maxlength'=>255,'size' => 45,'class'=>'form-control','placeholder' => 'Asunto')); ?>
              </div>
            </div>
        </div> 
        <?php 
        endif;
        ?>      	 
        <?php 
        if($action == "I"):
        ?>
        	<div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">        		
            		<?php echo $form->textArea($model, 'mensaje', array('class'=>'form-control','maxlength' => 300,'rows'=>'5','placeholder' => 'Ingrese su mensaje')); ?>       		
                  </div>
                </div>
            </div>
        <?php 
        else:
        ?> 
        	<div class="form-group">
        		<dl class="row" >
                    <dt class="col-sm-4">Usuario:</dt>
                    <dd class="col-sm-8"><?php echo $usuario->nombre_cliente;?></dd>
                    <dt class="col-sm-4">Asunto:</dt>
                    <dd class="col-sm-8"><?php echo $model->asunto;?></dd>
                    <dt class="col-sm-4">Pregunta:</dt>
                    <dd class="col-sm-8"><?php echo $model->mensaje;?></dd>
                    <?php 
                    if(!$responder):?>
                    	<dt class="col-sm-4">Respuesta:</dt>
                    	<dd class="col-sm-8"><?php echo $model->respuesta;?></dd>
                    <?php 
                    endif;?>
                </dl>
        	</div>
        	<?php 
        	if($responder && !$mensajeLlamada):?>
            	<div class="form-group">
                    <div class="form-row">
                      <div class="col-md-12">        		
                		<?php echo $form->textArea($model, 'respuesta', array('class'=>'form-control','maxlength' => 300,'rows'=>'5','placeholder' => 'Ingrese su mensaje')); ?>       		
                      </div>
                    </div>
                </div>
            <?php 
            endif;?>
        <?php 
        endif;
        ?>      
      </div>
      <div class="modal-footer">
      	<?php 
      	if(!$mensajeLlamada):?>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <?php 
            if($responder):?>
            	<?php echo CHtml::submitButton('Enviar',array('class'=>'btn btn-primary btn-procesar-datos')); ?>
            <?php 
            else:?>
            	<a href="#" class="btn btn-success btn_new_message" id="btn_nueva_entidad" data-id="false" data-action="I" title="Nueva Entidad" >
              		Nuevo Mensajes
              	</a>
            <?php 
            endif;?>
     	<?php 
     	endif;?>
      </div>
      <?php $this->endWidget(); ?>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<div class="row" >

	<div class="panel panel-primary">

        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6 col-xs-12">

                    <div class="m-t-20">
                        
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
                      <div class="modal-body">
                      	<?php 
                      	if(isset($action) && $action == 'I'):
                      	?>
                      	<div class="form-group">
                            <div class="form-row">
                              <?php 
                              if(Yii::app()->user->isSuperAdmin):
                              ?>
                              <div class="col-md-6">        		
                        		<?php echo $form->labelEx($model,'identidad'); ?>        		
                				<?php 
                        		$list = CHtml::listData(UsrEntidades::model()->findAll(array('order' => 'nombre_entidad')),'id', 'nombre_entidad'); 
                        		?> 
                        		<?php 
                        		echo $form->dropDownList($model,'identidad',$list,
                        		          array('empty' => '--Seleccione--','class'=>'form-control'));
                        		?>
                              </div>
                              <?php 
                              elseif(Yii::app()->user->hasState('entidad')):
                              ?>
                              	<input type="hidden" name="UsrMensajes[identidad]" value="<?php echo Yii::app()->user->getState('entidad')?>"/>
                              <?php 
                              endif;
                              ?>
                              <div class="col-md-6">      		
                        		<?php 
                        		$criteria=new CDbCriteria;
                        		$criteria->condition = "identidad = 15";
                        		$criteria->order = "nombre_cliente ASC";
                        		$list = CHtml::listData(UsrDeudas::model()->findAll($criteria),'rfc_cliente', 'nombre_cliente'); 
                        		?> 
                        		<?php 
                        		echo $form->dropDownList($model,'rfc_cliente',$list,
                        		          array('empty' => '--Seleccione el cliente--','class'=>'form-control'));
                        		?>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                              <div class="col-md-12">        		
                				<?php echo $form->textField($model,'asunto',array('maxlength'=>255,'size' => 45,'class'=>'form-control','placeholder' => 'Asunto')); ?>
                              </div>
                            </div>
                        </div> 
                        <?php 
                        endif;
                        ?>      	 
                        <?php 
                        if($action == "I"):
                        ?>
                        	<div class="form-group">
                                <div class="form-row">
                                  <div class="col-md-12">        		
                            		<?php echo $form->textArea($model, 'mensaje', array('class'=>'form-control','maxlength' => 300,'rows'=>'5','placeholder' => 'Ingrese su mensaje')); ?>       		
                                  </div>
                                </div>
                            </div>
                        <?php 
                        else:
                        ?> 
                        	<div class="form-group">
                        		<dl class="row" >
                                    <dt class="col-sm-4">Usuario:</dt>
                                    <dd class="col-sm-8"><?php echo $usuario->nombre_cliente;?></dd>
                                    <dt class="col-sm-4">Asunto:</dt>
                                    <dd class="col-sm-8"><?php echo $model->asunto;?></dd>
                                    <dt class="col-sm-4">Pregunta:</dt>
                                    <dd class="col-sm-8"><?php echo $model->mensaje;?></dd>
                                    <?php 
                                    if(!$responder):?>
                                    	<dt class="col-sm-4">Respuesta:</dt>
                                    	<dd class="col-sm-8"><?php echo $model->respuesta;?></dd>
                                    <?php 
                                    endif;?>
                                </dl>
                        	</div>
                        	<?php 
                        	if($responder && !$mensajeLlamada):?>
                            	<div class="form-group">
                                    <div class="form-row">
                                      <div class="col-md-12">        		
                                		<?php echo $form->textArea($model, 'respuesta', array('class'=>'form-control','maxlength' => 300,'rows'=>'5','placeholder' => 'Ingrese su mensaje')); ?>       		
                                      </div>
                                    </div>
                                </div>
                            <?php 
                            endif;?>
                        <?php 
                        endif;
                        ?>      
                      </div>
                      <div class="form-group">
                          <div>
                              <?php echo CHtml::submitButton('Registrar',array('class'=>'btn btn-primary')); ?> 
                              <a href="#" class="btn btn-success" >
                              		Volver
                              	</a>                       
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

