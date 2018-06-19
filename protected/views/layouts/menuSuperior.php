<ul class="navbar-nav ml-auto">	
	<?php 
	if(!Yii::app()->user->isSuperAdmin && Yii::app()->user->checkAccess('USER-SISTEMA')):
    ?>
    <li class="nav-item">
      <a class="nav-link" id="messagesDropdown" href="<?php echo Yii::app()->createUrl('PanelUsuarios/Mensajes')?>" >
        <i class="fa fa-fw fa-envelope"></i>
        <span class="d-lg-none">Messages
          <span class="badge badge-pill badge-primary">12 New</span>
        </span>
      </a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo Yii::app()->user->getState('usersistema');?>
        <span class="d-lg-none">
          <span class="badge badge-pill badge-primary">12 New</span>
        </span>
      </a>
      <div class="dropdown-menu" aria-labelledby="messagesDropdown">
        <h6 class="dropdown-header">Configuración de cuenta</h6>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('PanelUsuarios/PerfilUsuario')?>">
          <strong>Perfil</strong>
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?php echo Yii::app()->createUrl('PanelUsuarios/CambioDeClave')?>">
          <strong>Clave</strong>
        </a>
      </div>
    </li> 
    <?php 
    endif;
    ?>   
    <!-- li class="nav-item">
      <form class="form-inline my-2 my-lg-0 mr-lg-2">
        <div class="input-group">
          <input class="form-control" type="text" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-primary" type="button">
              <i class="fa fa-search"></i>
            </button>
          </span>
        </div>
      </form>
    </li> -->
    <li class="nav-item">
      <a class="nav-link" href="<?php echo Yii::app()->user->ui->logoutUrl?>" data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-fw fa-sign-out"></i>Salir
      </a>
    </li>
</ul>