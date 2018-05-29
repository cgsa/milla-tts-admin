<?php /* @var $this Controller */ ?>
<?php 
//echo Yii::app()->layout;die;
$this->beginContent('//layouts/main'); ?>
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