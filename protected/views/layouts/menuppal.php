<?php 
$baseUrl = Yii::app()->request->baseUrl;
?>
<div class="container clearfix">

    <div id="primary-menu-trigger"><i class="icon-reorder" style="color: #FFF"></i></div>

    <!-- Logo
    ============================================= -->
    <div id="logo">
        <a href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/index");?>" class="standard-logo" data-dark-logo="<?php echo $baseUrl?>/images/logo-dark.png"><img src="<?php echo $baseUrl?>/images/logo.png" alt="cancelamideuda"></a>
        <a href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/index");?>" class="retina-logo" data-dark-logo="<?php echo $baseUrl?>/images/logo-dark@2x.png"><img src="<?php echo $baseUrl?>/images/logo@2x.png" alt="cancelamideuda"></a>
    </div><!-- #logo end -->

    <!-- Primary Navigation
    ============================================= -->

    <nav id="primary-menu" >
        <ul>
            <!-- 
                <li class="sub-menu"><a href="#" class="sf-with-ul"><input type="search" style="background-image: url(<?php echo $baseUrl?>/images/search.png); background-repeat: no-repeat; background-position: center right;"></a></li>
             -->
             <?php 
             if(!Yii::app()->user->isGuest):?>
                <li class="sub-menu dropdown visible-xs">
                    <a class="dropdown-toggle"
                       data-toggle="dropdown"
                       href="#">
                        Acciones
                        <b class="caret"></b>
                      </a>
                    <ul class="dropdown-menu">
                    	<li class="sub-menu" >
                    		<a href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/importar");?>" class="sf-with-ul">
                                Deudas Activas
                            </a>
                    	</li>
                    	<li class="sub-menu" >
                    		<a href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/Mensajes");?>" class="sf-with-ul">
                                Mensajes
                            </a>
                    	</li>                	
                    </ul>
              </li>
              <li class="sub-menu">
                <a href="#" class="sf-with-ul">
                    <?php echo Yii::app()->user->getState('usersistema');?>
                </a>
              </li>
              <li class="sub-menu">
                <a href="<?php echo Yii::app()->user->ui->logoutUrl?>" class="sf-with-ul" >Salir</a>
              </li>
          <?php 
          endif;?>
      </ul>

        <!-- Top Cart
        ============================================= -->
        <div id="top-cart">
        	<?php 
             if(!Yii::app()->user->isGuest):?>
            	<a href="#" id="top-cart-trigger"><i class="icon-line2-question"></i></a>
            <?php 
            endif;?>
            <div class="top-cart-content">
            </div>
        </div><!-- #top-cart end -->


    </nav>


</div>