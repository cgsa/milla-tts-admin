<?php
/* @var $this ContactanosController */
/* @var $model Contactanos */
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
                            &nbsp;                           
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                  <th>Nombre</th>
                                  <th>Email</th>
                                  <th>Teléfono</th>
                                  <th class="sortingdisabled"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $rows = $model->findAll();
                            foreach ($rows as $key =>$value):
                          	?>
                                <tr>
                                  <td><?php echo $value->nombre." ".$value->apellido;?></td>
                                  <td><?php echo $value->email;?></td>
                                  <td><?php echo $value->telefono;?></td>
                                  <td>
                                  	<a href="<?php echo Yii::app()->createUrl('Contactanos/View',array('id'=>$value->id));?>" class="btn btn-default btn_operaciones" data-action="U" data-id="<?php echo $value->id;?>" >
                                  		<i class="fa fa-check-square-o" aria-hidden="true"></i>
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




