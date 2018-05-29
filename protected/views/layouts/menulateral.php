<?php 
$baseUrl = Yii::app()->request->baseUrl;
?>
<div class="col-md-3 col-sm-4 col-xs-12 bottommargin hidden-xs">
    <div class="sidebar-widgets-wrap">
		
        <div class="widget widget_links clearfix">
        <?php 
		if(!Yii::app()->user->isGuest):?>            
			<div class="panel-group" id="accordion">                  
                <div class="panel panel-default">
                	<?php 
                    if(!Yii::app()->user->isSuperAdmin && Yii::app()->user->checkAccess('USER-AGENTE')):?> 
                	<!-- Sección deudor -->
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#deudores"><span class="glyphicon glyphicon-folder-close">
                            </span>Administración Deudores</a>
                        </h4>
                    </div>
                    <div id="deudores" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                            	<tr>
                                    <td>
                                        <span class="glyphicon glyphicon-pencil text-primary"></span>
                                        <a href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/importar");?>">
                                        	Deudas Activas
                                        </a>
                                    </td>
                                </tr>
                            	<tr>
                                    <td>
                                        <span class="glyphicon glyphicon-pencil text-primary"></span>
                                        <a href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/Mensajes");?>">
                                        	Mensajes
                                        </a>
                                    </td>
                                </tr>
                            	<tr>
                                    <td>
                                        <span class="glyphicon glyphicon-pencil text-primary"></span>
                                        <a href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/HerramientasDisponibles");?>">
                                        	Herramientas
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php 
                    endif;?>
                   <?php 
                   if(Yii::app()->user->isSuperAdmin || Yii::app()->user->checkAccess('USER-CANCELO')):?>   
                    <!-- Sección acreedores -->
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#acreedores"><span class="glyphicon glyphicon-folder-close">
                            </span>Administración de Cuentas</a>
                        </h4>
                    </div>
                    <div id="acreedores" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                            	<tr>
                                    <td>
                                        <span class="glyphicon glyphicon-pencil text-primary"></span>
                                        <a href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/entidades");?>">
                                        	Acreedores
                                        </a>
                                    </td>
                                </tr>
                            	<tr>
                                    <td>
                                        <span class="glyphicon glyphicon-pencil text-primary"></span>
                                        <a href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/Agentes");?>">
                                        	Agentes
                                        </a>
                                    </td>
                                </tr>
                            	<tr>
                                    <td>
                                        <span class="glyphicon glyphicon-pencil text-primary"></span>
                                        <a href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/ClasificacionDeudores");?>">
                                        	Clasificación Deudores
                                        </a>
                                    </td>
                                </tr>
                            	<tr>
                                    <td>
                                        <span class="glyphicon glyphicon-pencil text-primary"></span>
                                        <a href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/herramientas");?>">
                                        	Herramientas
                                        </a>
                                    </td>
                                </tr>
                            	<tr>
                                    <td>
                                        <span class="glyphicon glyphicon-pencil text-primary"></span>
                                        <a href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/SolicitudLlamada");?>">
                                        	Solicitud de Llamada
                                        </a>
                                    </td>
                                </tr>
                                <?php 
                                if(Yii::app()->user->isSuperAdmin):?>
                            	<tr>
                                    <td>
                                        <span class="glyphicon glyphicon-pencil text-primary"></span>
                                        <a href="<?php echo Yii::app()->createUrl("/cruge/ui/usermanagementadmin");?>">
                                        	Administrador
                                        </a>
                                    </td>
                                </tr>
                                <?php 
                                endif;?>
                            </table>
                        </div>
                    </div>
                    <?php 
                    endif;?>
                </div>
            </div>            
		<?php 
		endif;?>           
        </div>
    </div>
</div>