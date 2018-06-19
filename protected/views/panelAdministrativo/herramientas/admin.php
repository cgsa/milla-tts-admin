<?php
/* @var $this PanelAdministrativoController */
/* @var $model Herramientas */

Yii::app()->clientScript->registerScript('search', "



    $('#datatable').dataTable();

    $('body').delegate('.btn_operaciones','click',function()
    {
        var action = $(this).attr('data-action');
        var id = $(this).attr('data-id');
        var param = {'action': action, 'id': id};
        bloqueoPantalla();
        
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('PanelAdministrativo/OperacionHerramientas')."',
            type:       'POST',
            data:       param,
            dataType:   'JSON',
            success:    function(_res)
            {
                desbloquePantalla();
                if(_res.status)
                {
                    $('#modalImportar').html(_res.formulario);
                    $('#modalImportar').modal({show:true,keyboard: false})
                }
                else
                {
                    swal(_res.mensaje);
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


    $('#modalImportar').on('hidden.bs.modal', function () {
     location.reload();
    });


    $('body').delegate('#Planes_idopcionpago','change',function()
    {
        var _val = $(this).find('option:selected').val();
        $('#Planes_fecha_desactivar').val('');
        $('#Planes_costo').val(0);
        switch(parseInt(_val))
        {
            case 1:
                $('#Planes_costo').attr('disabled','disabled');
                $('#Planes_fecha_desactivar').attr('disabled','disabled');
            break;
            case 2:
                $('#Planes_costo').attr('disabled',null);
                $('#Planes_fecha_desactivar').attr('disabled','disabled');
            break;
            case 3:
                $('#Planes_costo').attr('disabled','disabled');
                $('#Planes_fecha_desactivar').attr('disabled',null);
            break;
        }
    });

    $('body').delegate('.btn-procesar','click',function()
    {
        
        var param = $('#Planes_form').serialize();
        var _this = this;

        $.ajax(
        {
            url:        '".Yii::app()->createUrl('PanelAdministrativo/OperacionHerramientas')."',
            type:       'POST',
            data:       param,
            dataType:   'JSON',
            success:    function(_res)
            {
                desbloquePantalla();
                if(_res.status)
                {   
                    swal( _res.mensaje );
                    operacionesListPlanes(_this);
                    
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


    function operacionesListPlanes(_this)
    {

        var action = $(_this).attr('data-action');
        var id = $(_this).attr('data-id');
        var param = {'action': action, 'id': id};
        bloqueoPantalla();
        
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('PanelAdministrativo/OperacionHerramientas')."',
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

    }


    $('body').delegate('.agregar_elemento_json','click',function()
    {
        var _html = '';
        var contador = $(this).attr('data-index');
        if(contador < 6)
        {
            _html += add_dd( add_inputcodigo('codigo_'+contador) );
            _html += add_dd( add_inputvalue('valor_'+contador) );
    
            contador = parseInt(contador) + 1;
            $(this).attr('data-index',contador);
            $('#dl_body_config_json').append(_html);
        }
        
    });


    function add_dd(_title)
    {
        return '<dd class=\'col-sm-6\' >'+_title+'</dd>';
    }


    function add_dt(_title)
    {
        return '<dt class=\'col-sm-6\' >'+_title+'</dt>';
    }


    function add_inputcodigo(_name)
    {
        return '<input type= \'text\' class=\'form-control\' placeholder=\'Ingrese el código\' name=\'config['+_name+']\' value=\'\' />';
    }


    function add_inputvalue(_name)
    {
        return '<input type= \'text\' class=\'form-control\' placeholder=\'Ingrese el valor\' name=\'config['+_name+']\' value=\'\' />';
    }


    


    


    $('body').delegate('.btn-procesar-datos2','click',function()
    {

        var param = $('#herramientas_config_json').serialize();  
        bloqueoPantalla();
        
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('PanelAdministrativo/OperacionHerramientas')."',
            type:       'POST',
            data:       param,
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
                    bootbox.alert(_res.mensaje);
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


    $('body').delegate('.btn-procesar-datos','click',function()
    {

        //var param = $('#Planes_form').serialize();
        var param = new FormData($('#herramientas_form')[0]);  
        bloqueoPantalla();
        
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('PanelAdministrativo/OperacionHerramientas')."',
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

<!-- Start Row -->  
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="row">
                	<div class="col-xs-6 col-sm-3 m-b-30">
                        <div class="btn-group">
                            <button type="button" data-toggle="tooltip" class="btn btn-primary waves-effect btn_operaciones" data-id="false" data-action="I" title="Nueva Herramienta" >
                            	Nueva Herramienta
                            </button>                                
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                  <th>Nombre</th>
                                  <th>Código</th>
                                  <th class="sortingdisabled"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $rows = $model->findAll();
                            foreach ($rows as $key =>$value):
                          	?>
                                <tr>
                                  <td width="40%"><?php echo $value->nombre;?></td>
                                  <td width="40%"><?php echo $value->codigo;?></td>
                                  <td>
                                  	<a href="#" class="btn btn-default btn_operaciones" data-action="U" data-id="<?php echo $value->id;?>" >
                                  		<i class="fa fa-check-square-o" aria-hidden="true"></i>
                                  	</a>
                                  	<a href="#" class="btn btn-default btn_operaciones" data-action="LP" data-id="<?php echo $value->id;?>" >
                                  		<i class="fa fa-th-list" aria-hidden="true"></i>
                                  	</a>
                                  	<a href="#" class="btn btn-default btn_operaciones" data-action="JSON" title="JSON de configuración" data-id="<?php echo $value->id;?>" >
                                  		<i class="fa fa-code" aria-hidden="true"></i>
                                  	</a>
                                  </td>
                                </tr>
                            <?php                             
                            endforeach;
                            ?>                                                             
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<!-- End Row -->                            
<div class="modal fade" id="modalImportar" tabindex="-1" role="dialog"></div>
