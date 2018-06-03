<?php /* @var $this Controller */

$baseUrl = Yii::app()->request->baseUrl;
?>
<!DOCTYPE html>
<html>
<head>	
	<meta charset="utf-8">
	<meta name="language" content="en">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    
    <!-- Stylesheets
    ============================================= -->
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/vendor/bootstrap/css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/style.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/dark.css" type="text/css" />
    <link href="<?php echo $baseUrl; ?>/css/sb-admin.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/animate.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/responsive.css" type="text/css" />    
    <link href="<?php echo $baseUrl; ?>/css/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link rel="shortcut icon" href="images/ico.png" />
    <style type="text/css">
    body {
        margin: 0 !important;
        padding: 0 !important;
    }
    </style>
</head>

<body class="stretched">
  <!-- Document Wrapper
    ============================================= -->
    <div id="wrapper" class="clearfix">
    	<!-- Header
        ============================================= -->
        <header id="header">

            <div id="header-wrap">

                <?php include('menuppal.php');?>

            </div>

        </header><!-- #header end --> 
        
        <!-- Content
        ============================================= -->
        <section id="content" style="background-image: url(<?php echo $baseUrl?>/images/back.png); background-repeat: no-repeat; background-position: top left;">

            <div class="container">
            	<?php echo $content; ?>    
            </div>

        </section><!-- #content end -->
        
        <!-- Footer
        ============================================= -->
        <footer id="footer">


            <!-- Copyrights
            ============================================= -->
            <div id="copyrights">

                <div class="container clearfix" style="border-top: 1px solid #00315F">

                    <div class="col_full topmargin nobottommargin center">
                        <div class="copyrights-menu copyright-links clearfix">
                            <a href="#">CancelomiDeuda.com S.A.</a>|<a href="#">Trabajá con nosotros</a>|<a href="#">Aviso de privacidad Cancelo mi deuda</a>|<a href="#">Políticas de privacidad</a>|<a href="#">Ayuda</a>|
                            <a href="#"><i class="icon-facebook"></i></a>
                            <a href="#"><i class="icon-linkedin"></i></a>
                        </div>
                    </div>

                </div>

            </div><!-- #copyrights end -->

        </footer><!-- #footer end -->
        
        
    </div><!-- #wrapper end -->
    <!-- Go To Top
    ============================================= -->
    <div id="gotoTop" class="icon-angle-up"></div>

    
  	
    <!-- External JavaScripts
    ============================================= -->
	<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo $baseUrl; ?>/js/plugins.js"></script>	
    <!-- Footer Scripts
    ============================================= -->
    <script type="text/javascript" src="<?php echo $baseUrl?>/js/functions.js"></script>  
	<script type="text/javascript" src="<?php echo $baseUrl; ?>/assets/8c8cd6f4/jquery.maskedinput.js"></script>
    <script src="<?php echo $baseUrl; ?>/js/jquery.blockUI.js"></script>
    <script src="<?php echo $baseUrl; ?>/js/bootbox.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo $baseUrl; ?>/css/vendor/jquery-easing/jquery.easing.min.js"></script>   
    
</body>
</html>

