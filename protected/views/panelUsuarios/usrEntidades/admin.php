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
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="#">Entidades</a>
    </li>
    <li class="breadcrumb-item active">Administrador</li>
</ol>
<div class="modal fade" id="modalImportar" tabindex="-1" role="dialog"></div>
<div class="row">
    <div class="col-xl-2 col-sm-3 mb-3" align="center" >
      <a href="#" class="btn btn-success btn_operaciones" id="btn_nueva_entidad" data-id="false" data-action="I" title="Nueva Entidad" >
      	Nueva Entidad
      </a>
    </div>       
</div>
<div class="card mb-3" onload="">
    <div class="card-header">
      <i class="fa fa-table"></i> Listado de Entidades</div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="sortingdisabled">Logo</th>
              <th>Entidad</th>
              <th>Estado</th>
              <th class="sortingdisabled"></th>
            </tr>
          </thead>
          <tbody>
          	<?php 
          	
          	$criteria=new CDbCriteria;
          	$criteria->condition = "idestadoentidad = 1";          	
          	
          	$rows = $model->findAll($criteria);
          	
          	foreach ($rows as $key =>$value):
          	?>
                <tr>
                  <td><img class="d-flex mr-3" width="45" height="45" src="<?php echo Yii::app()->request->baseUrl .'/upload/img/'.$value->logo; ?>" alt=""></td>
                  <td><?php echo $value->nombre_entidad;?></td>
                  <td><?php echo ($value->idestadoentidad == 1)? 'Activo' : 'Inactivo';?></td>
                  <td>
                  	<a href="#" class="btn btn-default btn_operaciones" data-action="U" data-id="<?php echo $value->id;?>" >
                  		<i class="fa fa-check-square-o" aria-hidden="true"></i>
                  	</a>
                  	<a href="#" class="btn btn-default btn_delete" data-action="D" data-id="<?php echo $value->id;?>" >
                  		<i class="fa fa-trash" aria-hidden="true"></i>
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
