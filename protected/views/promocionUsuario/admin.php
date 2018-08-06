<?php
/* @var $this PromocionUsuarioController */
/* @var $model PromocionUsuario */

function calcularCantidad($objeto, $cantidadTotal)
{
    $producto = (int)$objeto->cant_cuotas * (int)$objeto->cant_millas;
    return $cantidadTotal / $producto;
}


Yii::app()->clientScript->registerScript('search', "


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
                            <!-- 
                            <a href="#" class="btn btn-primary waves-effect">
                            	<i class="fa fa-envelope-o" aria-hidden="true"></i>
                            	Alerta
                            </a> 
                             -->                             
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                  <th>Usuario</th>
                                  <th>Promoción</th>
                                  <th>Cuotas</th>
                                  <th>Cant</th>
                                  <th>Total Millas</th>
                                  <th>Monto Total</th>
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
                                  <td>
                                      <?php 
                                      $criteria=new CDbCriteria;
                                      $criteria->condition = "id_user =".$value->id_user;
                                      $usuario = UsuarioSistema::model()->find($criteria);
                                      //$usuario = Yii::app()->user->um->loadUserById($value->id_user,true);
                                      echo $usuario->nombre." ".$usuario->apellido;
                                      ?>
                                  </td>
                                  <td><?php echo $value->idPromocion->titulo;?></td>
                                  <td><?php echo $value->idCuotaPromocion->cant_cuotas;?></td>
                                  <td><?php echo calcularCantidad($value->idCuotaPromocion,$value->total_millas);?></td>
                                  <td><?php echo $value->total_millas;?></td>
                                  <td><?php echo $value->monto_total;?></td>
                                  <td><?php echo $model->getStatusLiteral($value->status);?></td>
                                  <td>
                                  	<a title="Detalle de la Compra" href="<?php echo Yii::app()->createUrl('PromocionUsuario/Detalle',array('id'=>$value->id));?>" class="btn btn-default" data-action="E" data-id="<?php echo $value->id;?>" >
                                  		<i class="fa fa-file-text-o" aria-hidden="true"></i>
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
