<?php
/* @var $this RegistroNuevoUsuarioController */
/* @var $model UsrUsuariosSistema */


Yii::app()->clientScript->registerScript('search', "
    
    
    
    
    $('#btn_registrar_new_usuario').click(function()
    {
        
        bloqueoPantalla();
    
        $.ajax(
        {
            url: '".Yii::app()->createUrl('registroNuevoUsuario/registrarusuario')."',
            type: 'POST',
            data: $('#usr-usuarios-sistema-form').serialize(),
            dataType: 'json',
            success: function(_res)
            {
                desbloquePantalla();
                if(_res.status)
                {
                    bootbox.alert(_res.mensaje, 
                    function()
                    { 
                        window.location.href='".Yii::app()->createUrl('site/login')."';
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
                bootbox.alert('Se produjó un error en el procesamiento de los correos.');
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
<?php $this->renderPartial('_form', array('model'=>$model)); ?>