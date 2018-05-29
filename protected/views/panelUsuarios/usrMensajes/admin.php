<?php
/* @var $this UsrMensajesController */
/* @var $model UsrMensajes */
$identidad = (isset($id))? $id : null;

Yii::app()->clientScript->registerScript('search', "
//btn-procesar-datos
    $('body').delegate('.btn_operaciones','click',function()
    {
        var action = $(this).attr('data-action');
        var id = $(this).attr('data-id');
        var _entidad = $(this).attr('data-entidad');
        var param = {'action': action, 'id': id, 'entidad':_entidad};
        bloqueoPantalla();
        
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('PanelUsuarios/OperacionMensajes')."',
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
                        url:        '".Yii::app()->createUrl('PanelAdministrativo/OperacionMensajes')."',
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
                                bootbox.alert(_res.mensaje);
                            }
                        },
                        error: function(_error)
                        {
                            desbloquePantalla();
                            bootbox.alert('Se produjó un error en el procesamiento del archivo.');
                        }
                    });
                }
            }
        });
    });

    $('body').delegate('.btn-procesar-datos','click',function()
    {
        var param = $('#usr_mensajes_form').serialize();
        bloqueoPantalla();
        
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('PanelUsuarios/OperacionMensajes')."',
            type:       'POST',
            data:       param,
            dataType:   'JSON',
            success:    function(_res)
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
<style type="text/css">
    .card
    {
        border: none !important;
    }
</style>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Mensajes</a>
    </li>
    <li class="breadcrumb-item active">Entidad</li>
</ol>
<div class="modal fade" id="modalImportar" tabindex="-1" role="dialog"></div>
<div class="row">
    <div class="col-xl-2 col-sm-3 mb-3" align="center" >
      <a href="#" class="btn btn-success btn_operaciones" id="btn_nueva_entidad" data-id="false" data-action="IU" title="Nueva Entidad" >
      	Nuevo Mensajes
      </a>
    </div>       
</div>
<div class="card mb-3">
	<div class="card-header">
  <i class="fa fa-envelope-o"></i> Listado de Mensajes
  </div>
    <div class="list-group list-group-flush small">
      <?php             
      $rows = $model->getMensajesUsuarios($identidad);
      
      foreach ($rows as $key =>$value):?>        
          <a class="list-group-item list-group-item-action btn_operaciones" data-entidad="<?php echo $value->identidad;?>" data-action="UU" data-id="<?php echo $value->id;?>" href="#">
            <div class="media">
              <div class="media-body">
                <strong><?php echo $value->identidad0->nombre_entidad;?></strong>
                <strong><?php echo $value->asunto;?></strong>.
                <div class="text-muted smaller"><?php echo date("d-m-Y", strtotime($value->fecha_carga));?></div>
              </div>
            </div>
          </a>
          <?php 
      endforeach;?>      
    </div>
</div>




