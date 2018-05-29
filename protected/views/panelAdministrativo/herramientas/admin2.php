<?php
/* @var $this PanelAdministrativoController */
/* @var $model Planes */
$baseUrl = Yii::app()->request->baseUrl;
Yii::app()->clientScript->registerScript('HD', "


");
?>

<div class="col-md-9 col-sm-8 col-xs-12">
    <div class="row">
    	<div class="col-md-1"></div>
    	<div class="col-md-11" >
    		<div class="row" >
    			<?php                      	
              	$criteria=new CDbCriteria;
              	$criteria->condition = "idestadoherramienta = 1";          	
              	
              	$rows = $model->findAll($criteria);
              	
              	foreach ($rows as $key =>$value):
              	?>  
              		<div class="col-md-3" >
              			<a data-toggle="tooltip" alt="<?php echo $value->nombre;?>" title="<?php echo $value->nombre;?>" href="<?php echo Yii::app()->createUrl("/PanelAdministrativo/Planes",array('id'=>$value->id,'herramienta'=>$value->codigo));?>" >
              				<img width="80%" src="<?php echo $baseUrl."/upload/img/".$value->logo;?>" /> 
              			</a> 
              		</div>
              	<?php 
              	endforeach;
              	?>	
    		</div>	
    	</div>
    </div>
</div>