<?php
/* @var $this UsrUsuariosSistemaController */
/* @var $model UsrUsuariosSistema */
$baseUrl = Yii::app()->request->baseUrl;


Yii::app()->clientScript->registerScript('perfil', "
    
    
    jQuery('#btn-actualizar-datos').click(function()
    {
        var param = $('#usr_usuario_clave_form').serialize();
        bloqueoPantalla();
        
        $.ajax(
        {
            url: '".Yii::app()->createUrl('PanelUsuarios/OperacionesPerfil')."',
            type: 'POST',
            data: param,
            dataType: 'json',
            success: function(_res)
            {
                desbloquePantalla();
                if(_res.status)
                {
                    bootbox.alert({
                        message: _res.mensaje,
                        callback: function () {
                            location.reload();
                        }
                    });
                }
                else
                {
                    bootbox.alert(_res.mensaje);
    
                }
            },
            error: function(_error)
            {
                desbloquePantalla();
                bootbox.alert('Se produjó un error en el procesamiento del archivo.');
            }
        });
    
    
        return false;
    
    });
    
    
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

<div id="modal_contenido" ></div>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="<?php echo Yii::app()->createUrl("PanelUsuarios/Deudas");?>">Usuario de Sistema</a>
    </li>
    <li class="breadcrumb-item active">Cambio de Clave</li>
</ol>
<div class="row">
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usr_usuario_clave_form',
    'action'=> "",
    'method'=> 'post',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,
    'htmlOptions' => array(),
    )); ?>
    <div class="col-md-12">
    	<div class="small">
            <dl class="row">
              <dt class="col-sm-4">Clave Nueva:</dt>
              <dd class="col-sm-8">
              	<?php echo $form->passwordField($model,'pass',
              	    array('size'=>50,'maxlength'=>50,'class'=>'form-control','id'=>'exampleInputPassword',"placeholder"=>"Ingrese su clave", "value"=>"")); ?>              	    
              	<input type="hidden" name="action" value="C" />
              </dd>
              
              <dt class="col-sm-4">Repita la Clave:</dt>
              <dd class="col-sm-8">
              	<?php echo $form->passwordField($model,'pass2',
              	    array('size'=>50,'maxlength'=>50,'class'=>'form-control','id'=>'exampleConfirmPassword1',"placeholder"=>"Repita su clave")); ?>
              </dd>
              
              <dt class="col-sm-8">&nbsp;&nbsp;&nbsp;</dt>
              <dd class="col-sm-4"><?php echo CHtml::Button('Nueva clave',array('class'=>'btn btn-primary','id'=>'btn-actualizar-datos')); ?></dd>                 
            </dl>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
