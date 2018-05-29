<?php 
$baseUrl = Yii::app()->request->baseUrl;
?>
<!-- Start Row -->  

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">				
              	<?php 
              	
              	$criteria=new CDbCriteria;
              	//$criteria->condition = "idestadoentidad = 1";          	
              	
              	$rows = $model->findAll($criteria);
              	$aux = 0;
              	foreach ($rows as $key =>$value):
              	
              	     $aux = ($aux == 3)? 0: $aux; 
              	?>
                  	<?php 
                  	if($aux == 0):
                  	?>
                    <div class="row">
                    <?php 
                    endif;
                    ?>
                    
                        <div class="col-md-4 text-center">
                        	<a href="<?php echo Yii::app()->createUrl("/GestionHerramientas/Activacion",array('id'=>$value->id,'herramienta'=>$value->codigo));?>" >
                                <h5><?php echo $value->nombre;?></h5>
                                <img width="40%" src="<?php echo $baseUrl."/upload/img/".$value->logo;?>" />
                            </a>
                        </div>
                    
                    <?php 
                    $aux++;
                  	if($aux == 3):
                  	?>
                    </div>
                    <?php 
                    endif;
                    ?>
				<?php 				
				endforeach;
				?>
            </div>
        </div>
    </div>

</div> <!-- End row -->
