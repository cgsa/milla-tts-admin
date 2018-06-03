<?php /* @var $this Controller */

$baseUrl = Yii::app()->request->baseUrl;
?>
<?php $this->beginContent('//layouts/mainadmin'); ?>
	
	<div class="content-wrap">

        <?php //include("menuppal.php");?>
    
    
        <div class="container clearfix">
            <div class="row">
                <div class="fancy-title title-bottom-border">
                    <h3><?php echo $this->titulopagina;?></h3>
                </div>
            </div>
        </div>
        
        <div class="container clearfix" style="padding: 0">
             <div class="col-md-12 hidden-xs">
                <img src="<?php echo $baseUrl;?>/images/logo-2.png" class="bottommargin-xs">
            </div>
    
            <?php include('menulateral.php');?>
    
            <div class="contenido">
                <?php echo $content; ?> 
            </div>
    
            <div class="clear"></div>
    
        </div>    
    
    </div>
            
<?php $this->endContent(); ?>