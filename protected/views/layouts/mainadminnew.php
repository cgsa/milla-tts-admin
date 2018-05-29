<?php /* @var $this Controller */

$baseUrl = Yii::app()->request->baseUrl;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="cancelomideuda.com" name="description" />
        <meta content="cancelomideuda.com" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="<?php echo $baseUrl; ?>/assets/assets/images/favicon.ico">
		
		<!-- DataTables -->
        <link href="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />
        
        <!--bootstrap-wysihtml5-->
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/assets/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css">
        
        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/assets/assets/plugins/morris/morris.css">
        <!-- Sweet Alert -->
        <link href="<?php echo $baseUrl; ?>/assets/assets/plugins/bootstrap-sweetalert/sweet-alert.css" rel="stylesheet" type="text/css">

        <link href="<?php echo $baseUrl; ?>/assets/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $baseUrl; ?>/assets/assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $baseUrl; ?>/assets/assets/css/style.css" rel="stylesheet" type="text/css">

    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <?php include('menuatopdminnew.php');?>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
			<?php include('menuleftadminnew.php');?>            
            <!-- Left Sidebar End -->

            <!-- Start right Content here -->
            <?php echo $content; ?>
            <!-- End Right content here -->

        </div>
        <!-- END wrapper -->


        <!-- jQuery  -->
        <script src="<?php echo $baseUrl; ?>/assets/assets/js/jquery.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/js/bootstrap.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/js/modernizr.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/js/detect.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/js/fastclick.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/js/jquery.slimscroll.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/js/jquery.blockUI.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/js/waves.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/js/wow.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/js/jquery.nicescroll.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/js/jquery.scrollTo.min.js"></script>
        
        <!-- Datatables-->
        <script src="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/jszip.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/plugins/datatables/dataTables.scroller.min.js"></script>
        
        
        <!-- Wysihtml js -->
        <script type="text/javascript" src="<?php echo $baseUrl; ?>/assets/assets/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
        <script type="text/javascript" src="<?php echo $baseUrl; ?>/assets/assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
        
		<!-- Sweet-Alert  -->
        <script src="<?php echo $baseUrl; ?>/assets/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js"></script>

        <script src="<?php echo $baseUrl; ?>/assets/assets/js/app.js"></script>
        
        <script type="text/javascript" src="<?php echo $baseUrl; ?>/assets/assets/plugins/parsleyjs/parsley.min.js"></script>

    </body>
</html>