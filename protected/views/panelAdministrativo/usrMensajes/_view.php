<?php
/* @var $this UsrMensajesController */
/* @var $model UsrMensajes */
/* @var $form CActiveForm */
$usuario = $model->getInfoUsuario($model->rfc_cliente);
?>

<div class="modal-dialog" >
    <div class="modal-content">
      <div class="modal-header">
      	<h4 class="modal-title" style="font-size: 16px;font-weight: bold;">Vista de Mensaje: <?php echo $model->getTipoMensaje($model->tipo);?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>        
      </div>
      <div class="modal-body">
      	<dl class="row" >
            <dt class="col-sm-4">Usuario:</dt>
            <dd class="col-sm-8"><?php echo $usuario->nombre_cliente;?></dd>
            <dt class="col-sm-4">Asunto:</dt>
            <dd class="col-sm-8"><?php echo $model->asunto;?></dd>
            <dt class="col-sm-4">Pregunta:</dt>
            <dd class="col-sm-8"><?php echo $model->mensaje;?></dd>
            <dt class="col-sm-4">Respuesta:</dt>
            <dd class="col-sm-8"><?php echo $model->respuesta;?></dd>
        </dl>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
      </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->