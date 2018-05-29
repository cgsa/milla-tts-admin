<?php
/* @var $this OlvidoDeClaveController */
/* @var $model UsrUsuariosSistema */


Yii::app()->clientScript->registerScript('search', "
    
    
    
    
    $('.btn-aceptar-recuperar').click(function()
    {
        
        bloqueoPantalla();
    
        $.ajax(
        {
            url: '".Yii::app()->createUrl('olvidoDeClave/NuevaClave')."',
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
                        window.location.href='".Yii::app()->createUrl('site/index')."';
                    });
                }
                else
                {
                    bootbox.alert(_res.mensaje, 
                    function()
                    { 
                        window.location.reload();
                    });
                    
                }
            },
            error: function(_error)
            {
                desbloquePantalla();
                bootbox.alert('Se produjó un error al intentar completar la operación.', 
                function()
                { 
                    window.location.reload();
                });
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
<?php $this->renderPartial('cambiarclave', array('model'=>$model)); ?>