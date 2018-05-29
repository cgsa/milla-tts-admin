<?php  
/* @var $this PanelAdministrativoController */
/* @var $model Planes */
$baseUrl = Yii::app()->request->baseUrl;
Yii::app()->clientScript->registerScript('HD', "
    
    
    $('.cls_activacion_plan').click(function()
    {
        var _id = $(this).attr('data-id');
        var _nombre = $(this).attr('data-name');
        var _param = {'id':_id, 'action':'AP'};
    
        bootbox.confirm('Está seguro de activar el plan: '+_nombre,
        function(result)
        {
            if(result)
            {
                enviarDatos(_param);
            }
    
        });
    
        return false;
    });
    
    
    $('body').delegate('.btn-procesar-datos','click',function()
    {
        var _param = $('#planes_entidad_form').serialize();
    
        enviarDatos(_param);
    
        return false;
    });
    
    
    $('.cls_config_plan').click(function()
    {
        var _id = $(this).attr('data-id');
        var _action= $(this).attr('data-action');
        var _param = {'id':_id, 'action':_action};
        if(_action == 'CP')
        {
            buscarFormulario(_param);
        }
        
    
        return false;
    });
    
    
    function buscarFormulario(param)
    {
        bloqueoPantalla();
    
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('GestionHerramientas/OperacionPlanes')."',
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
    
    function enviarDatos(param)
    {
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('GestionHerramientas/OperacionPlanes')."',
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


$criteria=new CDbCriteria;
$criteria->join = "LEFT JOIN usr_planes_entidad p ON t.id = p.idplan";
$criteria->condition = "p.identidad = ".Yii::app()->user->getState('entidad')." AND t.idestadoplan = 1";          	
$colors = array('primary', 'success','info','warning');
$rows = $model->findAll($criteria);
//var_dump($rows);die;
$aux = 0;
$i = 0;
foreach ($rows as $key =>$value):
    $aux = ($aux == 3)? 0: $aux; 
?>
    <?php 
    if($aux == 0):
    ?>
    <div class="row">
    <?php 
    endif;
    ?>
        <div class="col-lg-4">
            <div class="panel panel-fill panel-<?php echo $colors[$i]?>">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $value->nombre;?></h3>
                </div>
                <div class="panel-body">
                    <p>
                    	<?php echo $value->descripcion;?>
                    </p>
                    <div class="row">
                    	<?php 
                    	echo $model2->checkPlan( $value );
                    	?>
                    </div>
                </div>
            </div>
        </div>
    <?php 
    $aux++;
    $i++;
  	if($aux == 3):
  	?>
    </div>
    <!-- end row -->
    <?php 
    endif;
    ?>  
<?php 
endforeach;
?>
<div class="modal fade" id="modalImportar" tabindex="-1" role="dialog"></div>