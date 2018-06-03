<?php
/* @var $this DestinosController */
/* @var $model Destinos */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScript('destinos', "
    
$('.wysihtml5').wysihtml5();


function bloqueoPantalla()
{
    $.blockUI({ message: 'Espere un momento por favor...', css: {
        border: 'none',
        padding: '15px',
        backgroundColor: '#000',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
        opacity: .5,
        color: '#fff'
    } });
    
}
    
    
function desbloquePantalla()
{
    $(document).ready(function()
    {
        $.unblockUI({
            onUnblock: function(){
            }
        });
    });
}
    
");
?>

<!-- Start Row -->  
<div class="row">
	<!-- Horizontal form -->
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h4 class="m-t-0 m-b-30">Horizontal form</h4>
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'destinos-form',
                    'action'=> '',
                    'method'=> 'post',
                	// Please note: When you enable ajax validation, make sure the corresponding
                	// controller action is handling ajax validation correctly.
                	// There is a call to performAjaxValidation() commented in generated controller code.
                	// See class documentation of CActiveForm for details on this.
                    'enableAjaxValidation'=>false,
                    'htmlOptions' => array('class'=>'form-horizontal'),
                )); ?>
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'email',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">                            
                            <?php echo $form->textField($model,'email',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
							<?php echo $form->error($model,'email'); ?>
                        </div>
                    </div>
                    <?php 
                    if(!$model->isNewRecord):
                    ?>
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'fecha_registro',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                        	<span class="form-control" ><?php echo $model->fecha_registro;?></span>
                        </div>
                    </div>
                    <?php 
                    endif;
                    ?>
                    <div class="form-group" >
                    	<?php echo $form->labelEx($model,'status',array('class'=>'col-sm-3 control-label')); ?>
                    	<div class="col-sm-9">
                    		<?php 
                    		echo $form->dropDownList($model,'status',array('1' => 'Activo', '0' => 'Inactivo'),
                    		          array('empty' => '--Seleccione--','class'=>'form-control'));
                    		?>
                    		<?php echo $form->error($model,'status'); ?>
                    	</div>
                    </div> 
                    <div class="form-group m-b-0">
                        <div class="col-sm-offset-3 col-sm-9">
                        	<a href="<?php echo Yii::app()->createUrl("/Suscripciones/admin");?>"  class="btn btn-danger" >Volver</a>
                            <button type="submit" class="btn btn-info waves-effect waves-light">Registrar</button>
                        </div>
                    </div>
                <?php $this->endWidget(); ?>
            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- col -->
</div>
<!-- End Row -->

