<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="index.html" class="logo">
            	<img src="<?php echo $baseUrl;?>/images/logo-2.png" class="">
            </a>
            <a href="index.html" class="logo-sm"><span>C</span></a>
            <!--<a href="index.html" class="logo"><img src="<?php echo $baseUrl; ?>/assets/assets/images/logo_white_2.png" height="28"></a>-->
            <!--<a href="index.html" class="logo-sm"><img src="<?php echo $baseUrl; ?>/assets/assets/images/logo_sm.png" height="36"></a>-->
        </div>
    </div>
    <!-- Button mobile view to collapse sidebar menu -->
    <div class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="">
                <div class="pull-left">
                    <button type="button" class="button-menu-mobile open-left waves-effect waves-light">
                        <i class="ion-navicon"></i>
                    </button>
                    <span class="clearfix"></span>
                </div>

                <ul class="nav navbar-nav navbar-right pull-right">                    
                    <li class="hidden-xs">
                        <a href="#" id="btn-fullscreen" class="waves-effect waves-light notification-icon-box"><i class="mdi mdi-fullscreen"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                        	<?php 
                        	if(Yii::app()->user->hasState('logoentidad')):
                        	?>
                            	<img src="<?php echo $baseUrl; ?>/upload/img/<?php echo Yii::app()->user->getState('logoentidad');?>" alt="user-img" class="img-circle">
                            <?php 
                            endif;
                            ?>
                            <span class="profile-username">
                                <?php echo Yii::app()->user->getState('usersistema');?> <br/>
                            </span>
                        </a>
                        <?php 
                        include('enlaceperfil.php');
                        ?>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>