<?php
$baseUrl = Yii::app()->request->baseUrl;


Yii::app()->clientScript->registerScript('perfil', "
    

    

    jQuery('.btn-actualizar-datos').click(function(event)
    {
        var val1 = $('#CrugeStoredUser_newPassword').val();
        var val2 = $('#pass').val();
    
        if( val1 != val2 || ( val1 == '' || val2 == '' ) )
        {
           swal('Los campos de la claves no pueden estar vacias y deben coincidir.');
           return false; 
        }

        var param = $('#usr_formulario_cambioclave').serialize();
        
        swal({
            title: 'Está seguro?',
            text: 'Desea hacer el camvio de clave',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Si, cambiar!',
            cancelButtonText: 'No, cancelar!',
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) 
            {
                
                bloqueoPantalla();
    
                $.ajax(
                {
                    url: '".Yii::app()->createUrl('PanelAgentes/OperacionesPerfil')."',
                    type: 'POST',
                    data: param,
                    dataType: 'json',
                    success: function(_res)
                    {
                        desbloquePantalla();
                        if(_res.status)
                        {
                            swal(_res.mensaje);
                            location.reload();
                        }
                        else
                        {
                            swal(_res.mensaje);
            
                        }
                    },
                    error: function(_error)
                    {
                        desbloquePantalla();
                        swal('Se produjó un error en el procesamiento de los datos.');
                    }

                });

                    
            } 
            else 
            {
                swal('Cancelado', 'El proceso de cambio de clave se ha cancelado', 'error');
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

<div class="row" >

	<div class="panel panel-primary">

        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6 col-xs-12">

                    <div class="m-t-20">
                        <?php $form=$this->beginWidget('CActiveForm', array(
                    	'id'=>'usr_formulario_cambioclave',
                        'action'=> '',
                        'method'=> 'post',
                    	// Please note: When you enable ajax validation, make sure the corresponding
                    	// controller action is handling ajax validation correctly.
                    	// There is a call to performAjaxValidation() commented in generated controller code.
                        // See class documentation of CActiveForm for details on this.
                        'enableAjaxValidation' => false,
                        'htmlOptions' => array(),
                        )); ?>
                        	<input type="hidden" name="action" value="C" /> 
                            <div class="form-group">
                                <?php echo $form->labelEx($model,'password'); ?>
                                <input type="password" id="pass" class="form-control" required="true" placeholder="Ingrese su clave">
                            </div>
            
                            <div class="form-group">
                                <?php echo $form->labelEx($model,'newPassword'); ?>
                        		<?php echo $form->passwordField($model,'newPassword',
                        		    array('size'=>50,'maxlength'=>50,'class'=>'form-control','required'=>true,'data-parsley-equalto'=>'#pass',"placeholder"=>"Repita su clave",'autocomplete'=>'off', "value"=>"")); ?>
                            </div>
                            
                            <div class="form-group">
                                <div>
                                    <?php echo CHtml::Button('Actualizar',array('class'=>'btn btn-primary btn-actualizar-datos')); ?>                        
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