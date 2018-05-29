<?php
/* @var $this UsrUsuariosAgentesController */
/* @var $model UsrUsuariosAgentes */

Yii::app()->clientScript->registerScript('agentes', "


    $('#datatable').dataTable();

    $('body').delegate('.btn_operaciones','click',function()
    {
        var action = $(this).attr('data-action');
        var id = $(this).attr('data-id');
        var param = {'action': action, 'id': id};
        bloqueoPantalla();
    
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('PanelAdministrativo/OperacionAgentes')."',
            type:       'POST',
            data:       param,
            dataType:   'JSON',
            success:    function(_res)
            {
                desbloquePantalla();
                if(_res.status)
                {
                    $('#modalDialogo').html(_res.formulario);
                    $('#modalDialogo').modal({show:true})
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


    $('body').delegate('.btn-procesar-datos','click',function()
    {
        var action = $(this).attr('data-action');
        var id = $(this).attr('data-id');
        var param = $('#usr_usuarios_agentes_form').serialize();
        bloqueoPantalla();
    
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('PanelAdministrativo/OperacionAgentes')."',
            type:       'POST',
            data:       param,
            dataType:   'JSON',
            success:    function(_res)
            {
                desbloquePantalla();
                if(_res.status)
                {
                    $('#modalDialogo').html(_res.formulario);
                    $('#modalDialogo').modal({show:true})
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

<!-- Start Row -->  
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="row">
                	<div class="col-xs-6 col-sm-3 m-b-30">
                        <div class="btn-group">
                            <button type="button" id="btn-dialogo-importador" data-id="false" data-action="I" title="Nueva Entidad" data-toggle="tooltip" class="btn btn-primary waves-effect btn_operaciones">
                            	Nuevo Agente
                            </button>                                
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                  <th>Usuario</th>
                                  <th>Email</th>
                                  <th>Entidad</th>
                                  <th>Estado</th>
                                  <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                $criteria=new CDbCriteria;
                                $criteria->condition = "estadoagente = 1";
                                $rows = $model->findAll();
                                
                                foreach ($rows as $key =>$value):
                                $usuario = $value->getInfoUsuario($value->id);
                                ?>
                                    <tr>
                                      <td><?php echo $usuario->username;?></td>
                                      <td><?php echo $usuario->email;?></td>
                                      <td><?php echo $value->identidad0->nombre_entidad;?></td>
                                      <td><?php echo ($value->estadoagente == 1)? 'Activo' : 'Inactivo';?></td>
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
<div class="modal fade" id="modalDialogo" tabindex="-1" role="dialog"></div>

