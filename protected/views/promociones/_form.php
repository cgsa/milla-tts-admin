<?php
/* @var $this PromocionesController */
/* @var $model Promociones */
/* @var $form CActiveForm */

$baseUrl = Yii::app()->request->baseUrl;
Yii::app()->clientScript->registerScriptFile($baseUrl."/assets/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js", CClientScript::POS_END);


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
                    'id'=>'promociones-form',
                    'action'=> '',
                    'method'=> 'post',
                	// Please note: When you enable ajax validation, make sure the corresponding
                	// controller action is handling ajax validation correctly.
                	// There is a call to performAjaxValidation() commented in generated controller code.
                	// See class documentation of CActiveForm for details on this.
                    'enableAjaxValidation'=>false,
                    'htmlOptions' => array('class'=>'form-horizontal','enctype' => 'multipart/form-data'),
                )); ?>
                
                	<div class="form-group">
                        <?php echo $form->labelEx($model,'id_imagen',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <input type="file" class="filestyle" data-icon="false" name="Imagenes[Filedata]" data-buttonbefore="true">
                        </div>
                    </div> 
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'id_lugar',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9"> 
                        	<?php 
                    		$criteria=new CDbCriteria;
                    		$criteria->order = "nombre ASC";
                    		$list = CHtml::listData(Destinos::model()->findAll($criteria),'id', 'nombre'); 
                    		?> 
                    		<?php 
                    		echo $form->dropDownList($model,'id_lugar',$list,
                    		          array('empty' => '--Seleccione --','class'=>'form-control'));
                    		?>                           
                            <?php echo $form->error($model,'id_lugar'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'cant_millas',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model,'cant_millas',array('class'=>'form-control','size'=>60,'maxlength'=>20)); ?>
							<?php echo $form->error($model,'cant_millas'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'cant_cuotas',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model,'cant_cuotas',array('class'=>'form-control','size'=>60,'maxlength'=>20)); ?>
							<?php echo $form->error($model,'cant_cuotas'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'codigo_barra',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model,'codigo_barra',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
							<?php echo $form->error($model,'codigo_barra'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'fecha_vencimiento',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php 
                        	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        	    'model' => $model,
                        	    'attribute' => 'fecha_vencimiento',
                        	    'language' => 'es',
                        	    'options' => array(
                        	        'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"
                        	        'showOtherMonths' => true,      // show dates in other months
                        	        'selectOtherMonths' => true,    // can seelect dates in other months
                        	        'changeYear' => true,           // can change year
                        	        'changeMonth' => true,          // can change month
                        	        //'yearRange' => '2000:2099',     // range of year
                        	        'minDate' => '+1d',      // minimum date
                        	        //'maxDate' => '+1d',      // maximum date
                        	        'showButtonPanel' => true,      // show button panel
                        	    ),
                        	    'htmlOptions' => array(
                        	        'size' => '30',         // textField size
                        	        'maxlength' => '10',    // textField maxlength
                        	        'class' => 'form-control',
                        	    ),
                        	));
                        	?>                            
							<?php echo $form->error($model,'fecha_vencimiento'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'fecha_fin',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php 
                        	$this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        	    'model' => $model,
                        	    'attribute' => 'fecha_fin',
                        	    'language' => 'es',
                        	    'options' => array(
                        	        'dateFormat' => 'yy-mm-dd',     // format of "2012-12-25"
                        	        'showOtherMonths' => true,      // show dates in other months
                        	        'selectOtherMonths' => true,    // can seelect dates in other months
                        	        'changeYear' => true,           // can change year
                        	        'changeMonth' => true,          // can change month
                        	        //'yearRange' => '2000:2099',     // range of year
                        	        'minDate' => '+1d',      // minimum date
                        	        //'maxDate' => '+1d',      // maximum date
                        	        'showButtonPanel' => true,      // show button panel
                        	    ),
                        	    'htmlOptions' => array(
                        	        'size' => '30',         // textField size
                        	        'maxlength' => '10',    // textField maxlength
                        	        'class' => 'form-control',
                        	    ),
                        	));
                        	?>                            
							<?php echo $form->error($model,'fecha_fin'); ?>
                        </div>
                    </div>
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
                    <?php 
                    if(!$model->isNewRecord):
                    ?>
                    <div class="form-group m-b-5">
                    	<div class="col-sm-4"></div>
                    	<div class="col-sm-8">
                    		<img width="60%" src="<?php echo $baseUrl."/upload/img/".$model->idImagen->path;?>" />
                    	</div>
                    </div>
                    <?php 
                    endif;
                    ?>  
                    <div class="form-group m-b-0">
                        <div class="col-sm-offset-3 col-sm-9">
                        	<a href="<?php echo Yii::app()->createUrl("/Promociones/admin");?>"  class="btn btn-danger" >Volver</a>
                            <button type="submit" class="btn btn-info waves-effect waves-light">Registrar</button>
                        </div>
                    </div>
                <?php $this->endWidget(); ?>
            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- col -->
</div>
<!-- End Row -->




