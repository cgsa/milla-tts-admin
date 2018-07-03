<?php
/* @var $this SuscripcionesController */
/* @var $model Suscripciones */
Yii::app()->clientScript->registerScript('suscripciones', "
    
    
    
    $('#datatable').dataTable();

    $('.btn-difundir').click(function()
    {
        var _param = {'action':$(this).attr('data-action')};
        bloqueoPantalla();

        $.ajax(
        {
            url:        '".Yii::app()->createUrl('Suscripciones/EnviarPromociones')."',
            type:       'POST',
            data:       _param,
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
                	<div class="col-xs-6 col-sm-6 m-b-30">
                        <div class="btn-group">
                            <a href="<?php echo Yii::app()->createUrl('Suscripciones/Create');?>" class="btn btn-primary waves-effect">
                            	Nueva Suscripcion
                            </a> 
                            <button type="button" data-toggle="tooltip" data-action="DP" class="btn btn-success waves-effect btn-difundir">
                            	Difundir Promociones
                            </button>                           
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                  <th>email</th>
                                  <th>Fecha Registro</th>
                                  <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $rows = $model->findAll();
                            foreach ($rows as $key =>$value):
                          	?>
                                <tr>
                                  <td><?php echo $value->email;?></td>
                                  <td><?php echo $value->fecha_registro;?></td>
                  				  <td><?php echo ($value->status == 1)? 'Activo' : 'Inactivo';?></td>
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




