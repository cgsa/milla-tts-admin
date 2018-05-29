<?php 

//http://localhost/cancelo-admin/assets/8c8cd6f4/jquery.maskedinput.min.js
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/assets/8c8cd6f4/jquery.maskedinput.min.js", CClientScript::POS_END);
Yii::app()->clientScript->registerScript('perfil', "
    
    
    jQuery.mask.definitions={'n':'\x5B0\x2D9\x5D'};
    jQuery('#UsrUsuariosAgentes_telefono_particular').mask('+5nnnnnnnnnnnn');
    jQuery.mask.definitions={'n':'\x5B0\x2D9\x5D'};
    jQuery('#UsrUsuariosAgentes_telefono_movil').mask('+5nnnnnnnnnnnn');
    jQuery('#usr_perfil_agente').parsley();

");
?>
<div class="row" >
	
	<div class="panel panel-primary">

        <div class="panel-body">
        	<div class="row">
        		<div class="col-sm-8 col-xs-12">
        			<dl class="row" >
                        <dt class="col-sm-4">E-mail:</dt>
                        <dd class="col-sm-8"><?php echo $usuario->email;?></dd>
                        <dt class="col-sm-4">Entidad:</dt>
                        <dd class="col-sm-8">
                        	<?php 
                        	$entidad = UsrEntidades::model()->findByPk($agente->identidad);
                        	echo $entidad->nombre_entidad;
                        	?>
                        </dd>
                    </dl>
        		</div>
        	</div>
            <div class="row">
                <div class="col-sm-6 col-xs-12">

                    <div class="m-t-20">
                        <?php $form=$this->beginWidget('CActiveForm', array(
                    	'id'=>'usr_perfil_agente',
                        'action'=> "",
                        'method'=> 'post',
                    	// Please note: When you enable ajax validation, make sure the corresponding
                    	// controller action is handling ajax validation correctly.
                    	// There is a call to performAjaxValidation() commented in generated controller code.
                        // See class documentation of CActiveForm for details on this.
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array(),
                        )); ?>
                            <div class="form-group">
                                <?php echo $form->labelEx($agente,'telefono_particular'); ?>
                        		<?php echo $form->textField($agente,'telefono_particular',array('class'=>'form-control','required'=>true)); ?>                        		
                            </div>
                            
                            <div class="form-group">       		
                        		<?php echo $form->labelEx($agente,'telefono_movil'); ?>
                        		<?php echo $form->textField($agente,'telefono_movil',array('class'=>'form-control','required'=>true)); ?>
                            </div>
                            
                            <div class="form-group">
                                <div>
                                    <?php echo CHtml::submitButton('Registrar',array('class'=>'btn btn-primary')); ?>                        
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
