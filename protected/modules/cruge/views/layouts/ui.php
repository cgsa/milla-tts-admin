<?php
/*
	aqui: $this->beginContent('//layouts/main'); indica que este layout se amolda 
	al layout que se haya definido para todo el sistema, y dentro de el colocara
	su propio layout para amoldar a un CPortlet.
	
	esto es para asegurar que el sistema disponga de un portlet, 
	esto es casi lo mismo que haber puesto en UiController::layout = '//layouts/column2'
	a diferencia que aqui se indica el uso de un archivo CSS para estilos predefinidos
	
	Yii::app()->layout asegura que estemos insertando este contenido en el layout que
	se ha definido para el sistema principal.
*/
?>
<?php 
	/*$this->beginContent('//layouts/'.Yii::app()->layout); 
?>

<?php	
	if(Yii::app()->user->isSuperAdmin)
		echo Yii::app()->user->ui->superAdminNote();
?>
<div class="container-fluid">
	<div class="card mb-3" onload="">
      <!-- Breadcrumbs-->
      <!-- ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">My Dashboard</li>
      </ol> -->
      <?php if(isset($this->breadcrumbs)):?>
    		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
    			'links'=>$this->breadcrumbs,
    		)); ?><!-- breadcrumbs -->
    	<?php endif?>
    	<div class="row">
            <div class="col-xl-12 col-sm-12 mb-3">
          		<?php echo $content; ?>
          	</div>
      	</div>
  	</div>
</div>
<?php $this->endContent();*/ ?>

<?php 
//echo Yii::app()->layout;die;
$this->beginContent('//layouts/'.Yii::app()->layout); ?>
<div class="content-page">
    <!-- Start content -->
    <div class="content">

        <div class="">
            <div class="page-header-title">
                <h4 class="page-title">
                	<?php echo Yii::app()->user->ui->superAdminNote();?>                	
                </h4>
            </div>
        </div>

        <div class="page-content-wrapper ">
			<!-- Start container -->
			<?php echo $content; ?>
            <!-- container -->


        </div> <!-- Page content Wrapper -->

    </div> <!-- content -->

    <footer class="footer">
         © 2018 cancelomideuda.com - All Rights Reserved.
    </footer>

</div>
<?php $this->endContent(); ?>