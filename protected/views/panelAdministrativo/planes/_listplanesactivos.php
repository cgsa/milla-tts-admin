<?php
/* @var $this PanelAdministrativoController */
/* @var $model PlanesEntidad */
/* @var $form CActiveForm */
?>

<div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Lista de Planes Activos</h4>
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
                          <th>plan</th>
                          <th>Fecha Inicio</th>
                          <th>Fecha Fin</th>
                          <th class="sortingdisabled"></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                      //var_dump($model);die;
                      if(!is_null($model)):
                      ?>
                      	<?php 
                      	foreach ($model as $key=>$value):
                      	
                      	?>
                            <tr>
                              <td><?php echo $value->herramienta;?></td>
                              <td><?php echo $value->plan;?></td>
                              <td><?php echo $value->fecha_ini;?></td>
                              <td><?php echo $value->fecha_fin;?></td>
                              <td>
                              	<a href="#" class="btn btn-default btn_operaciones" data-action="UPP" data-id="<?php echo $value->id;?>" >
                              		<i class="fa fa-check-square-o" aria-hidden="true"></i>
                              	</a>
                              </td>
                            </tr>
                        <?php 
                        endforeach;
                        ?>
                      <?php 
                      endif;  
                      ?>
                      </tbody>
                    </table>                   
              	</div>
          	</div>              	         	
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <?php echo CHtml::submitButton('Activar Herramienta',array('data-action'=>'IAP','data-id'=>$id,'class'=>'btn btn-success btn_operaciones')); ?>
      </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->






