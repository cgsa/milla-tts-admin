<div class="form-group">
    <?php echo $form->labelEx($model,'titulo',array('class'=>'col-sm-3 control-label')); ?>
    <div class="col-sm-9">                            
        <?php echo $form->textField($model,'titulo',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'titulo'); ?>
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
    <?php echo $form->labelEx($model,'total_millas',array('class'=>'col-sm-3 control-label')); ?>
    <div class="col-sm-9">                            
        <?php echo $form->textField($model,'total_millas',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'total_millas'); ?>
    </div>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'cant_pasajes',array('class'=>'col-sm-3 control-label')); ?>
    <div class="col-sm-9">
        <?php echo $form->textField($model,'cant_pasajes',array('class'=>'form-control','size'=>60,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'cant_pasajes'); ?>
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

<div class="form-group">
	<?php echo $form->labelEx($model,'descripcion',array('class'=>'col-sm-3 control-label')); ?>
    <div class="col-sm-9">
        <?php echo $form->textArea($model,'descripcion',array('class'=>'form-control wysihtml5','rows'=>9)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
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