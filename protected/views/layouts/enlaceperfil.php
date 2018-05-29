<ul class="dropdown-menu">
	<?php 
	if(Yii::app()->user->checkAccess('USER-AGENTE') && !Yii::app()->user->isSuperAdmin):
	?>
    	<li><a href="<?php echo Yii::app()->createUrl("/PanelAgentes/Perfil");?>">Perfil</a></li>
    	<li><a href="<?php echo Yii::app()->createUrl("/PanelAgentes/CambioDeClave");?>"> Cambiar Clave</a></li>
    <?php 
    elseif (Yii::app()->user->isSuperAdmin || Yii::app()->user->checkAccess('USER-CANCELO')):
    ?>
    	<li><a href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/CambioDeClave");?>"> Cambiar Clave</a></li>
    <?php 
    endif;
    ?>
    <li class="divider"></li>
    <li><a href="<?php echo Yii::app()->user->ui->logoutUrl?>"> Salir</a></li>
</ul>