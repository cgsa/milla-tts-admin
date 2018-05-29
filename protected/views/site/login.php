<div class="panel-body">
    <h3 class="text-center m-t-0 m-b-15">
        <a href="index.html" class="logo logo-admin">
        	<img src="<?php echo Yii::app()->request->baseUrl;?>/images/logo-2.png" class="">
        </a>
    </h3>

    <?php $form=$this->beginWidget('CActiveForm', array(
    	'id'=>'logon-form',
    	'enableClientValidation'=>false,
    	'clientOptions'=>array(
    	    'validateOnSubmit'=>true,
    	),
        'htmlOptions'=>array(
            'class'=>'form-horizontal m-t-20',
        ),
    )); ?>

        <div class="form-group">
            <div class="col-xs-12">
                <?php echo $form->textField($model,'username',array('class'=>'form-control','id'=>'exampleInputEmail1', 'placeholder'=>'Usuario')); ?>
				<?php echo $form->error($model,'username'); ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-12">
                <?php echo $form->passwordField($model,'password',array('class'=>'form-control','id'=>'exampleInputPassword1', 'placeholder'=>'Usuario')); ?>
				<?php echo $form->error($model,'password'); ?>
            </div>
        </div>
        
        <div class="form-group text-center m-t-40">
            <div class="col-xs-12">
                <button class="btn btn-primary btn-block btn-lg waves-effect waves-light" type="submit">Login</button>
            </div>
        </div>
        
    <?php $this->endWidget(); ?>
</div>