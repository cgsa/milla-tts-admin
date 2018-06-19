<?php
/* @var $this UsrMensajesController */
/* @var $model UsrMensajes */


Yii::app()->clientScript->registerScript('search', "

    $('body').delegate('.btn_operaciones, .btn_new_message','click',function()
    {        
        
        var _parent = $(this).parents('tr');
        
        if( $(this).hasClass('btn_new_message') )
        {
            _parent = this;
        }

        var action = $(_parent).attr('data-action');
        var id = $(_parent).attr('data-id');
        var _estado = $(_parent).attr('data-status');
        var _tipo = $(_parent).attr('data-tipo');
        var param = {'action': action, 'id': id};
        bloqueoPantalla();

        if(action == 'U')
        {
            _control = $(_parent).attr('data-control');            
            if(_tipo == 1 && _estado == 0)
            {
                $('#' + _control).text('Leído');
            }
        }
        
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('PanelAdministrativo/OperacionMensajes')."',
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
                bootbox.alert('Se produjó un error en el procesamiento de los datos.');
            }
        }); 

        return false;
    });    


    $('body').delegate('.tabs','click',function()
    {
        $('.chk_seleccion').attr('checked', false);
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

    $('.a_cambiar_estado').click(function()
    {  
        var _action = $(this).attr('data-action');
        var _change = $(this).attr('data-id');
        _enviar = false;
        var param = { 'action':_action,'estado':_change,'datos': new Array() };
        var _objchk = $('.chk_seleccion');
        
        _objchk.each(function(i,obj)
        {
            if($(obj).is(':checked'))
            {
                _enviar = true;
                param.datos.push($(obj).val());
            }
            
        });       
        

        if(!_enviar)
        {
            _control = $(this).attr('data-control');            
            bootbox.alert('Debe seleccionar un mensaje para realizar la acción');
        }
        
        bloqueoPantalla();
        
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('PanelAdministrativo/OperacionMensajes')."',
            type:       'POST',
            data:       param,
            dataType:   'JSON',
            success:    function(_res)
            {
                desbloquePantalla();
                if(_res.status)
                {
                    window.location.reload();
                }
                else
                {
                    bootbox.alert(_res.mensaje);
                }
            },
            error: function(_error)
            {
                desbloquePantalla();
                bootbox.alert('Se produjó un error en el marcado de los mensajes.');
            }
        }); 

        return false;
    });


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

<style type="text/css">
    .card
    {
        border: none !important;
    }
    
    .btn_operaciones
    {
        cursor: pointer;
    }
</style>

<div class="col-md-9 col-sm-8 col-xs-12">
	<div class="row bottommargin-xs">		
        <div class="col-xl-12 col-sm-12 mb-3" align="left" >
            <div class="row">
            	<div class="col-md-1"></div>
            	<div class="col-xl-6 col-sm-8">
                    <div class="col-sm-3">
                    	<a href="#" class="btn btn-success btn_new_message" id="btn_nueva_entidad" data-id="false" data-action="I" title="Nueva Entidad" >
                        	Nuevo Mensajes
                        </a>
                    </div>
                    <div class="col-sm-1">
                    	<div class="dropdown show">
                          <a class="btn btn-secondary dropdown-toggle" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-font-awesome" aria-hidden="true"></i>
                          </a>
                        
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item a_cambiar_estado" data-action="M" data-id="2" href="#">Procesados</a>
                            <a class="dropdown-item a_cambiar_estado" data-action="M" data-id="6" href="#">Cerrado</a>
                            <a class="dropdown-item a_cambiar_estado" data-action="M" data-id="5" href="#">Posibles Pagos</a>
                          </div>
                        </div> 
                    </div>               
            	</div>
            </div>
        </div>       
    </div>
    <div class="row">
    	<div class="col-md-1"></div>
    	<div class="col-md-11" >
    		<div class="bs-example" data-example-id="media-list">
            	<div class="table-responsive">                    
                    <div id="exTab2" style="overflow: none;">	
                    	<ul class="nav nav-tabs">
                        	<li class="active">
                            	<a  href="#1" class="tabs" data-toggle="tab">Sin Leer</a>
                        	</li>
                        	<li>
                        		<a href="#2" class="tabs" data-toggle="tab">Procesado</a>
                        	</li>
                        	<li>
                        		<a href="#3" class="tabs" data-toggle="tab">Cerrados</a>
                        	</li>
                        	<li>
                        		<a href="#4" class="tabs" data-toggle="tab">Posibles Pagos</a>
                        	</li>
                        </ul>
                        <div class="tab-content ">
                        	<div class="tab-pane active" id="1">
                           		<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                    <?php 
                                  	
                                  	$criteria=new CDbCriteria;
                                  	$criteria->condition = "estadomensaje IN (0,1) AND identidad = ".Yii::app()->user->getState('entidad');
                                  	$rows = $model->findAll($criteria);
                                  	
                                  	foreach ($rows as $key =>$value):
                                  	    $usuario = $value->getInfoUsuario($value->rfc_cliente);                                  	     
                                        if(!is_null($usuario)):
                                  	?>
                                        <tr data-control="txtEstados<?php echo $value->estadomensaje;?>" title="Abrir Mensaje" data-status="<?php echo $value->estadomensaje;?>"  data-tipo="<?php echo $value->tipo;?>" data-action="U" data-id="<?php echo $value->id;?>" >
                                          <td><input type="checkbox" class="chk_seleccion" value="<?php echo $value->id;?>"></td>
                                          <td class="btn_operaciones"><?php echo $usuario->nombre_cliente;?></td>
                                          <td class="btn_operaciones"><?php echo $value->asunto;?></td>
                                          <td class="btn_operaciones" id="txtEstados<?php echo $value->estadomensaje;?>" ><?php echo $model->getEstadoMensaje($value->estadomensaje);?></td>
                                          <td class="btn_operaciones"><?php echo date("d-m-Y", strtotime($value->fecha_carga));?></td>
                                        </tr>
                                    <?php 
                                        endif;
                                    endforeach;
                                    ?>
                                  </thead>
                                </table>
                        	</div>
                        	<div class="tab-pane" id="2">
                            	<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                    <?php 
                                  	
                                  	$criteria=new CDbCriteria;
                                  	$criteria->condition = "estadomensaje = 2 AND identidad = ".Yii::app()->user->getState('entidad');
                                  	$rows = $model->findAll($criteria);
                                  	
                                  	foreach ($rows as $key =>$value):
                                        $usuario = $value->getInfoUsuario($value->rfc_cliente);
                                        if(!is_null($usuario)):
                                  	?>
                                        <tr data-control="txtEstados<?php echo $value->estadomensaje;?>" title="Abrir Mensaje" data-status="<?php echo $value->estadomensaje;?>"  data-tipo="<?php echo $value->tipo;?>" data-action="U" data-id="<?php echo $value->id;?>" >
                                          <td><input type="checkbox" class="chk_seleccion" value="<?php echo $value->id;?>"></td>
                                          <td class="btn_operaciones"><?php echo $usuario->nombre_cliente;?></td>
                                          <td class="btn_operaciones"><?php echo $value->asunto;?></td>
                                          <td class="btn_operaciones" id="txtEstados<?php echo $value->estadomensaje;?>" ><?php echo $model->getEstadoMensaje($value->estadomensaje);?></td>
                                          <td class="btn_operaciones"><?php echo date("d-m-Y", strtotime($value->fecha_carga));?></td>
                                        </tr>
                                    <?php 
                                        endif;
                                    endforeach;
                                    ?>
                                  </thead>
                                </table>
                        	</div>
                          	<div class="tab-pane" id="3">
                           		<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                                    <?php 
                                  	
                                  	$criteria=new CDbCriteria;
                                  	$criteria->condition = "estadomensaje = 6 AND identidad = ".Yii::app()->user->getState('entidad');
                                  	$rows = $model->findAll($criteria);
                                  	
                                  	foreach ($rows as $key =>$value):
                                  	    $usuario = $value->getInfoUsuario($value->rfc_cliente);
                                        if(!is_null($usuario)):
                                  	?>
                                        <tr data-control="txtEstados<?php echo $value->estadomensaje;?>" title="Abrir Mensaje" data-status="<?php echo $value->estadomensaje;?>"  data-tipo="<?php echo $value->tipo;?>" data-action="U" data-id="<?php echo $value->id;?>" >
                                          <td><input type="checkbox" class="chk_seleccion" value="<?php echo $value->id;?>"></td>
                                          <td class="btn_operaciones"><?php echo $usuario->nombre_cliente;?></td>
                                          <td class="btn_operaciones"><?php echo $value->asunto;?></td>
                                          <td class="btn_operaciones" id="txtEstados<?php echo $value->estadomensaje;?>" ><?php echo $model->getEstadoMensaje($value->estadomensaje);?></td>
                                          <td class="btn_operaciones"><?php echo date("d-m-Y", strtotime($value->fecha_carga));?></td>
                                        </tr>
                                    <?php 
                                        endif; 
                                    endforeach;
                                    ?>
                                  </thead>
                                </table>
                        	</div>
                        	<div class="tab-pane" id="4" >
                           		<table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                                  <thead>
                            		<?php                                   	
                                  	$criteria=new CDbCriteria;
                                  	$criteria->condition = "estadomensaje = 5 AND identidad = ".Yii::app()->user->getState('entidad');
                                  	$rows = $model->findAll($criteria);
                                  	
                                  	foreach ($rows as $key =>$value):
                                        $usuario = $value->getInfoUsuario($value->rfc_cliente);
                                        if(!is_null($usuario)):
                                  	?>
                                        <tr data-control="txtEstados<?php echo $value->estadomensaje;?>" title="Abrir Mensaje" data-status="<?php echo $value->estadomensaje;?>"  data-tipo="<?php echo $value->tipo;?>" data-action="U" data-id="<?php echo $value->id;?>" >
                                          <td><input type="checkbox" class="chk_seleccion" value="<?php echo $value->id;?>"></td>
                                          <td class="btn_operaciones"><?php echo $usuario->nombre_cliente;?></td>
                                          <td class="btn_operaciones"><?php echo $value->asunto;?></td>
                                          <td class="btn_operaciones" id="txtEstados<?php echo $value->estadomensaje;?>" ><?php echo $model->getEstadoMensaje($value->estadomensaje);?></td>
                                          <td class="btn_operaciones"><?php echo date("d-m-Y", strtotime($value->fecha_carga));?></td>
                                        </tr>
                                    <?php
                                        endif;
                                    endforeach;
                                    ?>
                                  </thead>
                                </table>
                        	</div>
                        </div>
              		</div>                    
              </div>
            </div>    		
    	</div>
    </div>
</div>
<div class="modal fade" id="modalImportar" tabindex="-1" role="dialog"></div>