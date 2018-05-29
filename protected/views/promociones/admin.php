<?php
/* @var $this PromocionesController */
/* @var $model Promociones */


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
                            <a href="<?php echo Yii::app()->createUrl('Promociones/Create');?>" class="btn btn-primary waves-effect">
                            	Nueva Promocion
                            </a>                              
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                  <th>Destino</th>
                                  <th>Millas</th>
                                  <th>Cuotas</th>
                                  <th>F. Vencimiento</th>
                                  <th>Cant. Pasaje</th> 
                                  <th>Estatus</th>                                  
                                  <th class="sortingdisabled"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $rows = $model->findAll();
                            foreach ($rows as $key =>$value):
                          	?>
                                <tr>
                                  <td><?php echo $value->idLugar->nombre;?></td>
                                  <td><?php echo $value->cant_millas;?></td>
                                  <td><?php echo $value->cant_cuotas;?></td>
                                  <td><?php echo $value->fecha_vencimiento;?></td>
                                  <td><?php echo $value->cant_pasajes;?></td>
                                  <td><?php echo $value->status;?></td>
                                  <td>
                                  	<a href="<?php echo Yii::app()->createUrl('Promociones/Update',array('id'=>$value->id));?>" class="btn btn-default" data-action="U" data-id="<?php echo $value->id;?>" >
                                  		<i class="fa fa-check-square-o" aria-hidden="true"></i>
                                  	</a>
                                  	<a href="<?php echo Yii::app()->createUrl('Promociones/Imagenes',array('id'=>$value->id));?>" class="btn btn-default btn_operaciones" data-action="U" data-id="<?php echo $value->id;?>" >
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




