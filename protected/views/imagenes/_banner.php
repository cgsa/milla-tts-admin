<div class="form-group" >
	<?php echo $form->labelEx($model,'controlador',array('class'=>'col-sm-3 control-label')); ?>
	<div class="col-sm-9">
		<?php 
		echo $form->dropDownList($model,'controlador',array('destinos' => 'Destinos', 'promociones' => 'Promociones'),
		          array('empty' => '--Seleccione--','class'=>'form-control'));
		?>
		<?php echo $form->error($model,'controlador'); ?>
	</div>
</div>
<div class="form-group" >
	<?php echo $form->labelEx($model,'id_contralador',array('class'=>'col-sm-3 control-label')); ?>
	<?php 
	$list = array();
    ?>
	<div class="col-sm-9">
		<?php 
		echo $form->dropDownList($model,'id_contralador',$list,
		          array('empty' => '--Seleccione--','class'=>'form-control'));
		?>
		<?php echo $form->error($model,'id_contralador'); ?>
	</div>
</div> 
<div class="form-group">
    <?php echo $form->labelEx($model,'nombre',array('class'=>'col-sm-3 control-label')); ?>
    <div class="col-sm-9">
        <?php echo $form->textField($model,'nombre',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'nombre'); ?>
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