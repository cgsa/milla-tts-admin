<?php
/* @var $this UsrUsuariosAgentesController */
/* @var $model UsrUsuariosAgentes */

Yii::app()->clientScript->registerScript('agentes', "
//btn-procesar-datos
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
                        url:        '".Yii::app()->createUrl('PanelAdministrativo/OperacionAgentes')."',
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
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Agentes</a>
    </li>
    <li class="breadcrumb-item active">Administrador</li>
</ol>
<div class="modal fade" id="modalImportar" tabindex="-1" role="dialog"></div>
<div class="row">
    <div class="col-xl-2 col-sm-3 mb-3" align="center" >
      <a href="#" class="btn btn-success btn_operaciones" id="btn_nueva_entidad" data-id="false" data-action="I" title="Nueva Entidad" >
      	Nuevo Agente
      </a>
    </div>       
</div>
<div class="card mb-3" onload="">
    <div class="card-header">
      <i class="fa fa-table"></i> Listado de Agentes</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
