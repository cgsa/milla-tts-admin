<?php
/* @var $this PanelAdministrativoController */
/* @var $model PlanesEntidad */
/* @var $form CActiveForm */
$baseUrl = Yii::app()->request->baseUrl;
?>
<div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Formulario de Activación</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>        
      </div>
      <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'herramientas_config_json',
        'action'=> Yii::app()->createUrl('PanelAdministrativo/Operacion'),
        'method'=> 'post',
    	// Please note: When you enable ajax validation, make sure the corresponding
    	// controller action is handling ajax validation correctly.
    	// There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        ));           
          
          $numero = 0;
          if(!empty($model->json_config))
          {
              $array = json_decode($model->json_config);
              $numero = count($array->config);
          }
          
            
      ?>
        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
        <input type="hidden" id="action" name="action" value="JSON">
      <div class="modal-body">
      	<div class="form-group">
            <div class="form-row">
              <div class="col-md-12">       		
        		<img class="agregar_elemento_json" data-index="<?php echo ( $numero == 0 )? 1 : $numero + 1;?>" style="cursor: pointer;" alt="Agregar un elemento al json" src="<?php echo $baseUrl."/images/icon-inbox2.png";?>">
              </div>
            </div>
        </div>   
        <div class="row" >        	
            <div class="form-group" id="div_config_json">
                <div class="form-row">
                  <div class="col-md-12">        		
            		<?php echo $form->labelEx($model,'json_config'); ?>        		
        			<dl id="dl_body_config_json" >  
        				<?php 
        				if($numero > 0):
        				    
                        	//var_dump($array->config);die;
                        	$i = 1;
                        	foreach($array->config as $key=>$value):
                        	?>
                      			<dd class='col-sm-6'><input type='text' class='form-control' autocomplete="off" name='config[codigo_<?php echo $i;?>]' value='<?php echo $key;?>' maxlength="100" /></dd>
                      			<dd class='col-sm-6'><input type='text' class='form-control' autocomplete="off" name='config[valor_<?php echo $i;?>]' value='<?php echo $value;?>' maxlength="100" /></dd>
                      		<?php
                      		$i++;
                            endforeach;
                            
                        endif;
                        ?>               
                    </dl>            		
                  </div>
                </div>
            </div> 
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <?php echo CHtml::submitButton('Registrar',array('class'=>'btn btn-primary btn-procesar-datos2')); ?>
      </div>
      <?php $this->endWidget(); ?>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->