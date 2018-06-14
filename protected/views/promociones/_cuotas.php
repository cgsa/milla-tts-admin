<?php
/* @var $this PromocionesController */
/* @var $model Promociones */
/* @var $form CActiveForm */

$baseUrl = Yii::app()->request->baseUrl;


Yii::app()->clientScript->registerScript('destinos', "
    

$('#datatable').dataTable();

$('.btn-dialogo-form').click(function()
{
    var _action = $(this).attr('data-action');
    var _id = $(this).attr('data-id');
    var _param = {'action':_action,'id':_id};
    
    $.ajax(
    {
        url:   '".Yii::app()->createUrl('Promociones/Formulario')."',
        type:  'POST',
        data:  _param,
        dataType: 'JSON',
        success: function(_res)
        {
            desbloquePantalla();
            if(_res.status)
            {
                $('#modalDialog').html(_res.formulario);
                $('#modalDialog').modal({show:true,keyboard: false});
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


$('body').delegate('.btn-procesar-formulario','click',function()
{    
    var _url = '".Yii::app()->createUrl('Promociones/Registrar')."';
    var _param = $('#formulario-form').serialize();
    
    enviarDatos( _param, _url );
    
    return false;
});


function enviarDatos( param, url )
{
    $.ajax(
    {
        url:        url,
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
            swal( 'Se produjó un error en el procesamiento los datos.' );
        }
    });

}
    
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
	<!-- Horizontal form -->
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
            	<div class="row">
                	<div class="col-xs-6 col-sm-4 m-b-30">
                        <div class="btn-group">
                        	<a href="<?php echo Yii::app()->createUrl('Promociones/Admin');?>" class="btn btn-primary waves-effect ">
                          		Volver
                          	</a>
                            <button type="button" data-id="<?php echo $model->id;?>" data-toggle="tooltip" data-action="IC" class="btn btn-default waves-effect btn-dialogo-form">Agregar Cuota</button>                                
                        </div>
                    </div>
                </div>               
                <div class="form-group m-b-0">                
                	<div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                      <th>Cuotas</th>
                                      <th>Millas</th>
                                      <th>F. Activa</th>                                  
                                      <th class="sortingdisabled"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $criteria=new CDbCriteria;
                                $criteria->condition = "id_promocion =".$model->id;
                                $rows = $model2->findAll( $criteria );
                                foreach ($rows as $key =>$value):
                              	?>
                                    <tr>
                                      <td><?php echo $value->cant_cuotas;?></td>
                                      <td><?php echo $value->cant_millas;?></td>
                                      <td><?php echo $value->fecha_activa;?></td>
                                      <td>
                                      	<a href="" class="btn btn-default btn-dialogo-form" data-action="UC" data-id="<?php echo $value->id;?>" >
                                      		<i class="fa fa-edit" aria-hidden="true"></i>
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
            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- col -->
</div>
<!-- End Row -->
<div class="modal fade" id="modalDialog" tabindex="-1" role="dialog"></div>

