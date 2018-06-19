<div class="topbar">
    <!-- LOGO -->
    <div class="topbar-left">
        <div class="text-center">
            <a href="<?php echo Yii::app()->createUrl("/site/index");?>" class="logo">
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
                <?php 
                /*
                ?>
                <form class="navbar-form pull-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control search-bar" placeholder="Search...">
                    </div>
                    <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                </form>
				<?php 
				*/
				?>
				
                <ul class="nav navbar-nav navbar-right pull-right">
                	<?php 
                	/*
                	?>
                    <li class="dropdown hidden-xs">
                        <a href="#" data-target="#" class="dropdown-toggle waves-effect waves-light notification-icon-box" data-toggle="dropdown" aria-expanded="true">
                            <i class="fa fa-bell"></i> <span class="badge badge-xs badge-danger"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg">
                            <li class="text-center notifi-title">Notification <span class="badge badge-xs badge-success">3</span></li>
                            <li class="list-group">
                               <!-- list item-->
                               <a href="javascript:void(0);" class="list-group-item">
                                  <div class="media">
                                     <div class="media-heading">Your order is placed</div>
                                     <p class="m-0">
                                       <small>Dummy text of the printing and typesetting industry.</small>
                                     </p>
                                  </div>
                               </a>
                               <!-- list item-->
                                <a href="javascript:void(0);" class="list-group-item">
                                  <div class="media">
                                     <div class="media-body clearfix">
                                        <div class="media-heading">New Message received</div>
                                        <p class="m-0">
                                           <small>You have 87 unread messages</small>
                                        </p>
                                     </div>
                                  </div>
                                </a>
                                <!-- list item-->
                                <a href="javascript:void(0);" class="list-group-item">
                                  <div class="media">
                                     <div class="media-body clearfix">
                                        <div class="media-heading">Your item is shipped.</div>
                                        <p class="m-0">
                                           <small>It is a long established fact that a reader will</small>
                                        </p>
                                     </div>
                                  </div>
                                </a>
                               <!-- last list item -->
                                <a href="javascript:void(0);" class="list-group-item">
                                  <small class="text-primary">See all notifications</small>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php 
                    */
                    ?>
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