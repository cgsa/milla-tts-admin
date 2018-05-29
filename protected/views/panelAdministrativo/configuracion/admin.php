<?php
/* @var $this UsrEntidadesController */
/* @var $model UsrEntidades */

Yii::app()->clientScript->registerScript('search', "
//btn-procesar-datos
    $('body').delegate('.btn_operaciones','click',function()
    {
        var action = $(this).attr('data-action');
        var id = $(this).attr('data-id');
        var param = {'action': action, 'id': id};
        bloqueoPantalla();
        
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('PanelAdministrativo/OperacionEntidades')."',
            type:       'POST',
            data:       param,
            dataType:   'JSON',
            success:    function(_res)
            {
                desbloquePantalla();
                if(_res.status)
                {
                    $('#modalImportar').html(_res.formulario);
                    $('#modalImportar').modal({show:true})
                }
                else
                {
                    swal( _res.mensaje );
                }
            },
            error: function(_error)
            {
                desbloquePantalla();
                swal( 'Se produjó un error en el procesamiento los datos.' );
            }
        }); 

        return false;
    });


    $('body').delegate('.btn_delete','click',function()
    {
        var _id = $(this).attr('data-id'); 
        bootbox.confirm({
            message: 'Esta seguro que desea eliminar el registro?',
            buttons: {
                confirm: {
                    label: 'Aceptar',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'Cancelar',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                
                if(result)
                {

                    var param = {'action':'D', 'id': _id};

                    $.ajax(
                    {
                        url:        '".Yii::app()->createUrl('PanelAdministrativo/OperacionEntidades')."',
                        type:       'POST',
                        data:       param,
                        dataType:   'JSON',
                        success:    function(_res)
                        {
                            desbloquePantalla();
                            if(_res.status)
                            {
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
                            swal( 'Se produjó un error al procesar los datos.' );
                        }
                    });
                }
            }
        });
    });

    $('body').delegate('.btn-procesar-datos','click',function()
    {
        var param = new FormData($('#usr_entidades_form')[0]);
        bloqueoPantalla();
        
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('PanelAdministrativo/OperacionEntidades')."',
            type:       'POST',
            data:       param,
            contentType: false,
            processData: false,
            dataType:   'JSON',
            success:    function(_res)
            {
                desbloquePantalla();
                if(_res.status)
                {
                    swal( _res.mensaje );
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
                swal( 'Se produjó un error al procesar los datos.' );
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

<div class="col-md-9 col-sm-8 col-xs-12">	
    <div class="row">
    	<div class="col-md-1"></div>
    	<div class="col-md-11" >
    		 <div class="col-xl-3 col-sm-6 mb-3">
             	<i class="fa fa-tags fa-4" aria-hidden="true"></i>
            </div>   		
    	</div>
    </div>
</div>
<div class="modal fade" id="modalImportar" tabindex="-1" role="dialog"></div>