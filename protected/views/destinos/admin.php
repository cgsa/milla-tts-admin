<?php
/* @var $this DestinosController */
/* @var $model Destinos */
Yii::app()->clientScript->registerScript('destino', "
    
    
    
    $('#datatable').dataTable();
    
");
?>

<!-- Start Row -->  
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="row">
                	<div class="col-xs-6 col-sm-3 m-b-30">
                        <div class="btn-group">
                            <a href="<?php echo Yii::app()->createUrl('Destinos/Create');?>" class="btn btn-primary waves-effect">
                            	Nuevo Destino
                            </a>                              
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                  <th>Ciudad</th>
                                  <th>Nombre</th>
                                  <th class="sortingdisabled"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $rows = $model->findAll();
                            foreach ($rows as $key =>$value):
                          	?>
                                <tr>
                                  <td><?php echo $value->ciudad;?></td>
                                  <td><?php echo $value->nombre;?></td>
                                  <td>
                                  	<a href="<?php echo Yii::app()->createUrl('Destinos/Update',array('id'=>$value->id));?>" class="btn btn-default" data-action="U" data-id="<?php echo $value->id;?>" >
                                  		<i class="fa fa-check-square-o" aria-hidden="true"></i>
                                  	</a>
                                  	<a href="<?php echo Yii::app()->createUrl('Destinos/Imagenes',array('id'=>$value->id));?>" class="btn btn-default btn_operaciones" data-action="U" data-id="<?php echo $value->id;?>" >
                                  		<i class="fa fa-file-image-o" aria-hidden="true"></i>
                                  	</a>
                                  </td>
                                </tr>
                            <?php                             
                            endforeach;
                            ?>                                                             
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<!-- End Row -->                            
<div class="modal fade" id="modalImportar" tabindex="-1" role="dialog"></div>




