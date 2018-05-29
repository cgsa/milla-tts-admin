<?php
/* @var $this UsrEntidadesController */
/* @var $model UsrEntidades */
$baseUrl = Yii::app()->request->baseUrl;

function statusUsuario($cod)
{
    $result = "Inactivo";
    
    switch ($cod) {
        case 1:
            $result = "Clientes";
        break;
        
        case 2:
            $result = "No clientes";
        break;
        
    }
    
    return $result;
}


Yii::app()->clientScript->registerScript('search', "
//btn-procesar-datos


    $('#datatable').dataTable();

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
                swal( 'Se produjó un error al procesar los datos.' );
            }
        }); 

        return false;
    });


    $('#modalImportar').on('hidden.bs.modal', function () {
     location.reload();
    });


    $('body').delegate('#PlanesEntidad_idherramienta','change', function()
    {
        
        var _id = $(this).find('option:selected').val();
        var entidad = $('#PlanesEntidad_identidad').val();
        $('#PlanesEntidad_idplan').html('<option>--Seleccione--</option>');
        $('#div_config_json').hide();
        $('#dl_body_config_json').empty();

        if(_id != '')
        {
            var _param = {'action': 'PP', 'id':_id, 'entidad':entidad};

            bloqueoPantalla();
        
            $.ajax(
            {
                url:        '".Yii::app()->createUrl('PanelAdministrativo/OperacionEntidades')."',
                type:       'POST',
                data:       _param,
                dataType:   'JSON',
                success:    function(_res)
                {
                    desbloquePantalla();
                    if(_res.status)
                    {
                        $('#PlanesEntidad_idplan').html(_res.combo);
                        $('#dl_body_config_json').html(_res.cjson);
                        $('#div_config_json').show();
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
                    swal( _res.mensaje );
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



    $('body').delegate('.btn-procesar-datos2','click',function()
    {
        var param = $('#planes_entidad_form').serialize();
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

<!-- Start Row -->  
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="row">
                	<div class="col-xs-6 col-sm-3 m-b-30">
                        <div class="btn-group">
                            <button type="button" data-toggle="tooltip" class="btn btn-primary waves-effect btn_operaciones" data-id="false" data-action="I" title="Nueva Entidad">
                            	Nuevo Acreedor
                            </button>                                
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                  <th class="sortingdisabled">Logo</th>
                                  <th>Acreedor</th>
                                  <th>Estado</th>
                                  <th class="sortingdisabled"></th>
                                </tr>
                            </thead>
                            <tbody>
                              	<?php 
                              	
                              	$criteria=new CDbCriteria;
                              	//$criteria->condition = "idestadoentidad  1";          	
                              	
                              	$rows = $model->findAll($criteria);
                              	
                              	foreach ($rows as $key =>$value):
                              	?>
                                    <tr>
                                      <td><img class="d-flex mr-3" width="45" height="45" src="<?php echo Yii::app()->request->baseUrl .'/upload/img/'.$value->logo; ?>" alt=""></td>
                                      <td><?php echo $value->nombre_entidad;?></td>
                                      <td><?php echo statusUsuario($value->idestadoentidad);?></td>
                                      <td>
                                      	<a href="#" class="btn btn-default btn_operaciones" title="Actualizar datos entidad" data-action="U" data-id="<?php echo $value->id;?>" >
                                      		<i class="fa fa-check-square-o" aria-hidden="true"></i>
                                      	</a>
                                      	<a href="#" class="btn btn-default btn_operaciones" title="Administración planes" data-action="LP" data-id="<?php echo $value->id;?>" >
                                      		<i class="fa fa-th-list" aria-hidden="true"></i>
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

