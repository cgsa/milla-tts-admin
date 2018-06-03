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
    <!-- Bootstrap core CSS-->
    <link href="<?php echo $baseUrl; ?>/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="<?php echo $baseUrl; ?>/css/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="<?php echo $baseUrl; ?>/css/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="<?php echo $baseUrl; ?>/css/sb-admin.css" rel="stylesheet">
    
</head>

<body class="sticky-footer bg-light" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg static-top navbar-light bg-light" id="mainNav">
    <a class="navbar-brand" href="<?php echo Yii::app()->createUrl('PanelUsuarios/Deudas');?>">
    	<img width="200" height="60" src="<?php echo $baseUrl;?>/images/logocancelo.png" />
    </a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <?php include_once 'menuLeft.php';?>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <?php include_once 'menuSuperior.php';?>
    </div>
  </nav>
  <div class="content-wrapper">
  	<?php echo $content; ?>
  	
  	<?php include_once 'footer.php';?>
  	
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo $baseUrl; ?>/css/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo $baseUrl; ?>/css/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo $baseUrl; ?>/css/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?php echo $baseUrl; ?>/css/vendor/datatables/jquery.dataTables.js"></script>
    <script src="<?php echo $baseUrl; ?>/css/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="<?php echo $baseUrl; ?>/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="<?php echo $baseUrl; ?>/js/sb-admin-datatables.min.js"></script>
    <script src="<?php echo $baseUrl; ?>/js/bootbox.min.js"></script>   
    <script src="<?php echo $baseUrl; ?>/js/jquery.blockUI.js"></script>
  </div>
</body>
</html>
