<?php
/* @var $this PanelAdministrativoController */
/* @var $model Planes */
/* @var $form CActiveForm */
?>

<div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Lista de Planes</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>        
      </div>
      <div class="modal-body">
      	<div class="row" >
    		<div class="bs-example" data-example-id="media-list">      		
          		<div class="table-responsive">                    
                    <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Herramienta</th>
                          <th>Nombre</th>
                          <th>Costo</th>
                          <th class="sortingdisabled"></th>
                        </tr>
                      </thead>
                      <tbody>
                      	<?php 
                      	
                      	$criteria=new CDbCriteria;
                      	$criteria->condition = "idherramienta = ".$id;  
                      	//var_dump($model);die;
                      	$rows = $model->findAll($criteria);
                      	
                      	foreach ($rows as $key =>$value):
                      	?>
                            <tr>
                              <td><?php echo $value->idherramienta0->nombre;?></td>
                              <td><?php echo $value->nombre;?></td>
                              <td><?php echo $value->costo;?></td>
                              <td>
                              	<a href="#" class="btn btn-default btn_operaciones" data-action="UP" data-id="<?php echo $value->id;?>" >
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
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <?php echo CHtml::submitButton('Nuevo Plan',array('data-action'=>'IP','data-id'=>$id,'class'=>'btn btn-success btn_operaciones')); ?>
      </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->