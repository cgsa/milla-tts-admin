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
        
        buscarFormulario(_param);
        
        return false;
    });

    
    function buscarFormulario(param)
    {
        bloqueoPantalla();
        
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('PanelAdministrativo/OperacionPlanes')."',
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
            url:        '".Yii::app()->createUrl('PanelAdministrativo/OperacionPlanes')."',
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
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <div class="row">
    	<div class="col-md-1"></div>
    	<div class="col-md-11" >
    		<div class="row" >
    			<?php                      	
              	$criteria=new CDbCriteria;
              	$criteria->select = "t.*, pe.planactivo";
              	$criteria->join = "LEFT JOIN (
                                    	SELECT idplan,count(id) as planactivo
                                    	FROM usr_planes_entidad 
                                        WHERE idestadoplanentidad = 1 AND identidad = ".Yii::app()->user->getState('entidad')." GROUP BY idplan,identidad
                                    ) pe ON pe.idplan = t.id";
              	$criteria->condition = "t.idherramienta = ".$id." AND t.idestadoplan = 1";          	
              	
              	$rows = $model->findAll($criteria);
              	//var_dump($rows);die;
              	foreach ($rows as $key =>$value):
              	?>  
              		<div class="col-md-3" style="min-height: 300px;">
              			<div class="card" style="width: 18rem;height: auto;">
                          <div class="card-body">
                            <h5 class="card-title"><?php echo $value->nombre;?></h5>
                            <p class="card-text" style="height: 120px;"><?php echo $value->descripcion;?></p>
                            <?php 
                            if($value->idopcionpago == 3):
                            ?>
                                <h5 class="card-title">Temporal Finaliza: <?php echo $value->fecha_desactivar;?></h5>
                                
                                <div class="btn-group">
                                  <button type="button" class="btn btn-default dropdown-toggle"
                                          data-toggle="dropdown">
                                    Activo <span class="caret"></span>
                                  </button>
                                 
                                  <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" data-id="<?php echo $value->id;?>" >Configuración</a></li>
                                    <li><a href="#" data-id="<?php echo $value->id;?>" >Cancelar Plan</a></li>
                                  </ul>
                                </div>
                            <?php 
                            else:
                            ?>
                            	<h5 class="card-title">$<?php echo $value->costo;?></h5>
                                <?php 
                                if($model2->planActivo($value->id)):
                                ?>
                                	<div class="btn-group">
                                      <button type="button" class="btn btn-default dropdown-toggle"
                                              data-toggle="dropdown">
                                        Activo <span class="caret"></span>
                                      </button>
                                     
                                      <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" data-id="<?php echo $value->id;?>" class="cls_config_plan" data-action="CP" >Configuración</a></li>
                                    	<li><a href="#" data-id="<?php echo $value->id;?>" >Cancelar Plan</a></li>
                                      </ul>
                                    </div>
                                <?php                                 
                                elseif(is_null($value->planactivo)):
                                ?>
                                	<a href="#" data-name="<?php echo $value->nombre;?>" data-id="<?php echo $value->id;?>" class="btn btn-primary cls_activacion_plan">Activar</a>
                                <?php 
                                endif;
                                ?>
                            <?php 
                            endif;
                            ?>
                            
                          </div>
                        </div>
              		</div>
              	<?php 
              	endforeach;
              	?>
              	<div class="row"></div>	
    		</div>	
    	</div>
    </div>
</div>
<div class="modal fade" id="modalImportar" tabindex="-1" role="dialog"></div>