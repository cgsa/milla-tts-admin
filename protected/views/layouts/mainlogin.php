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

        <link rel="shortcut icon" href="<?php echo $baseUrl; ?>/<?php echo $baseUrl; ?>/assets/assets/<?php echo $baseUrl; ?>/assets/assets/images/favicon.ico">

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/assets/assets/plugins/morris/morris.css">

        <link href="<?php echo $baseUrl; ?>/assets/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $baseUrl; ?>/assets/assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="<?php echo $baseUrl; ?>/assets/assets/css/style.css" rel="stylesheet" type="text/css">

    </head>
    <body>

        <!-- Begin page -->
        <?php echo $content; ?>
        <!-- Begin page -->
        


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

        <!--Morris Chart-->
        <script src="<?php echo $baseUrl; ?>/assets/assets/plugins/morris/morris.min.js"></script>
        <script src="<?php echo $baseUrl; ?>/assets/assets/plugins/raphael/raphael-min.js"></script>

        <script src="<?php echo $baseUrl; ?>/assets/assets/pages/dashborad.js"></script>

        <script src="<?php echo $baseUrl; ?>/assets/assets/js/app.js"></script>

    </body>
</html>