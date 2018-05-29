<div class="left side-menu">
	<?php 
	if(!Yii::app()->user->isGuest):
	?> 
    <div class="sidebar-inner slimscrollleft">

        <div class="user-details">
            <div class="text-center">
            	<?php 
            	if(Yii::app()->user->hasState('logoentidad')):
            	?>
                	<img src="<?php echo $baseUrl; ?>/upload/img/<?php echo Yii::app()->user->getState('logoentidad');?>" alt="user-img" class="img-circle">
                <?php 
                endif;
                ?>
            </div>
            <div class="user-info">
                <div class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><?php echo Yii::app()->user->getState('usersistema');?></a>
                    <?php 
                    include('enlaceperfil.php');
                    ?>
                </div>

                <p class="text-muted m-0"><i class="fa fa-dot-circle-o text-success"></i> Online</p>
            </div>
        </div>
        <!--- Divider -->


        <div id="sidebar-menu">
            <ul>                
				<?php 
                if(!Yii::app()->user->isSuperAdmin && Yii::app()->user->checkAccess('USER-AGENTE')):
				?>
				<li>
                    <a href="<?php echo Yii::app()->createUrl("/PanelAgentes/index");?>" class="waves-effect">
                    	<i class="mdi mdi-home"></i><span>Inicio</span>
                    </a>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-square-inc-cash"></i> <span> Gestión Deudas </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo Yii::app()->createUrl("/GestionDeudas/importar");?>">Importar Deudas</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("/GestionDeudas/Preguntas");?>">Preguntas</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("/GestionDeudas/etiquetas");?>">Etiquetas</a></li>
                    </ul>
                </li>

                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="mdi mdi-wrench"></i> 
                        <span> Herramientas </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo Yii::app()->createUrl("/GestionHerramientas/");?>">Herramientas Disponibles</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("/GestionHerramientas/Configuracion");?>">Configuración</a></li>
                    </ul>
                </li>
				<?php 
				endif;
				?>  
				
				<?php 
				/***
				 * Bloque de enlaces administrativos.
				 * */				
                if(Yii::app()->user->isSuperAdmin || Yii::app()->user->checkAccess('USER-CANCELO')):
                ?>
				<li>
                    <a href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/index");?>" class="waves-effect">
                    	<i class="mdi mdi-home"></i><span>Inicio</span>
                    </a>
                </li>
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="mdi mdi-bank"></i> 
                        <span>Panel</span> <span class="pull-right"><i class="mdi mdi-plus"></i></span>
                    </a>
                    <ul class="list-unstyled">
                        <li><a href="<?php echo Yii::app()->createUrl("/Imagenes/admin");?>">Imagenes</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("/Banner/admin");?>">Banner</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("/Destinos/admin");?>">Destinos</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/Agentes");?>">Galerias</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/ClasificacionDeudores");?>">Clasificación</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/herramientas");?>">Herramientas</a></li>
                        <li><a href="<?php echo Yii::app()->createUrl("/EnlacesPagina/admin");?>">Enlaces</a></li>
                    </ul>
                </li>
                
                <?php 
                endif;
                ?>
                
                <?php 
				/***
				 * Bloque de enlaces administrativos.
				 * */				
                if( Yii::app()->user->isSuperAdmin ):
                ?>
                
                    <?php 
                    $i = 0;
                    $list = Yii::app()->user->ui->adminItemsAlternative;
                    $aIconos = array('account-key','database-plus','clipboard-text','desktop-tower');
                    foreach ($list as $key=>$value):
                    ?> 
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect">
                            <i class="mdi mdi-<?php echo $aIconos[$i];?>"></i> 
                            <span>
                            	<?php 
                            	$label = $value['label'];
                            	
                            	if($label == "Roles and Assignments")
                            	{
                            	    $label = "Roles";
                            	}
                            	
                            	echo $label;?>
                            </span> 
                            <span class="pull-right"><i class="mdi mdi-plus"></i></span>
                        </a>
                        <ul class="list-unstyled">
                        	<?php 
                          	foreach ($value['items'] as $key2 => $value2):
                          	?>
                            <li><a href="<?php echo $value2['url']?>"><?php echo $value2['label']?></a></li>
                            <?php 
                            endforeach;
                            ?>
                        </ul>
                    </li>
                    <?php
                    $i++;
                    endforeach;
                    ?>
                <?php 
                endif;
                ?>               
            </ul>
        </div>
        <div class="clearfix"></div>
    </div> <!-- end sidebarinner -->
    <?php 
    endif;
    ?>
</div>