<?php
/* @var $this UsrUsuariosSistemaController */
/* @var $model UsrUsuariosSistema */
$baseUrl = Yii::app()->request->baseUrl;


Yii::app()->clientScript->registerScript('perfil', "
    
    
    jQuery('#btn-actualizar-datos').click(function()
    {
        var param = $('#usr_perfil_form').serialize();
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
      <a href="<?php echo Yii::app()->createUrl("PanelUsuarios/Deudas");?>">Perfil</a>
    </li>
    <li class="breadcrumb-item active">Usuario de Sistema</li>
</ol>
<div class="row">
	<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usr_perfil_form',
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
              <dt class="col-sm-4">RFC:</dt>
              <dd class="col-sm-8"><?php echo $model->rfc;?></dd>
              
              <dt class="col-sm-4">Nombre:</dt>
              <dd class="col-sm-8"><?php echo $model->nombre;?></dd>
              
              <dt class="col-sm-4">Apellido:</dt>
              <dd class="col-sm-8"><?php echo $model->apellido;?></dd>
              
              <dt class="col-sm-4">Fecha de Nacimiento:</dt>
              <dd class="col-sm-8"><?php echo date("d-m-Y", strtotime($model->fecha_nacimiento));?></dd>
              
              <dt class="col-sm-4">Teléfono Particular:</dt>
              <dd class="col-sm-8">
              	<input type="hidden" name="action" value="P" />
              	<?php
                    $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'telefono_particular',
                    //'mask' => '+549-9999999999',
                    'mask'        => '+549nnnnnnnnnn',
                    'charMap'     => array('n' => '[0-9]'),
                    'htmlOptions' => array('size' => 40)
                    ));
                ?>
              </dd>
              
              <dt class="col-sm-4">Teléfono Movil:</dt>
              <dd class="col-sm-8">
              	<?php
                    $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'telefono_movil',
                    //'mask' => '+549-9999999999',
                    'mask'        => '+549nnnnnnnnnn',
                    'charMap'     => array('n' => '[0-9]'),
                    'htmlOptions' => array('size' => 40)
                    ));
                ?>
              </dd>
              
              <dt class="col-sm-4">Opciones de Domicilio:</dt>
              <dd class="col-sm-8">&nbsp;</dd>
              
              <dt class="col-sm-4">Calle:</dt>
              <dd class="col-sm-8"><?php echo $form->textField($model,'domicilio_particular_calle',array('maxlength'=>50,'size' => 40)); ?></dd>
              
              <dt class="col-sm-4">Numero Exterior:</dt>
              <dd class="col-sm-8"><?php echo $form->textField($model,'domicilio_particular_numero_exterior',array('maxlength'=>10,'size' => 40)); ?></dd>
               
              <dt class="col-sm-4">Numero Interior:</dt>
              <dd class="col-sm-8"><?php echo $form->textField($model,'domicilio_particular_numero_interior',array('maxlength'=>10,'size' => 40)); ?></dd>
               
              <dt class="col-sm-4">Código Postal:</dt>
              <dd class="col-sm-8"><?php echo $form->textField($model,'domicilio_particular_cp',array('maxlength'=>10,'size' => 40)); ?></dd>
              
              <dt class="col-sm-4">Colonia:</dt>
              <dd class="col-sm-8"><?php echo $form->textField($model,'domicilio_particular_colonia',array('maxlength'=>30,'size' => 40)); ?></dd>
              
              <dt class="col-sm-4">Población:</dt>
              <dd class="col-sm-8"><?php echo $form->textField($model,'domicilio_particular_poblacion',array('maxlength'=>30,'size' => 40)); ?></dd>
              
              <dt class="col-sm-4">Estado:</dt>
              <dd class="col-sm-8"><?php echo $form->textField($model,'domicilio_particular_estado',array('maxlength'=>30,'size' => 40)); ?></dd>
              
              <dt class="col-sm-8">&nbsp;&nbsp;&nbsp;</dt>
              <dd class="col-sm-4"><?php echo CHtml::Button('Actualizar',array('class'=>'btn btn-primary','id'=>'btn-actualizar-datos')); ?></dd>                 
            </dl>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
