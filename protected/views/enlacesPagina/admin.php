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
            url:        '".Yii::app()->createUrl('EnlacesPagina/Dialogo')."',
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



    $('body').delegate('.btn-procesar-datos','click',function()
    {

        var param = $('#enlaces_pagina_form').serialize();  
        bloqueoPantalla();
        
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('EnlacesPagina/Registrar')."',
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
                            <button type="button" data-toggle="tooltip" class="btn btn-primary waves-effect btn_operaciones" data-id="false" data-action="I" title="Nuevo Enlace" >
                            	Nuevo Enlace
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
                                  <th>URL</th>
                                  <th class="sortingdisabled"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $rows = $model->findAll();
                            foreach ($rows as $key =>$value):
                          	?>
                                <tr>
                                  <td><?php echo $value->nombre;?></td>
                                  <td><?php echo $value->codigo;?></td>
                                  <td><?php echo $value->url;?></td>
                                  <td>
                                  	<a href="#" class="btn btn-default btn_operaciones" data-action="U" data-id="<?php echo $value->id;?>" >
                                  		<i class="fa fa-check-square-o" aria-hidden="true"></i>
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
