<?php
/* @var $this UsrMensajesController */
/* @var $model MensajesInterno */


Yii::app()->clientScript->registerScript('search', "

     
    function bloqueoPantalla()
    {
        $.blockUI({ message: 'Espere un momento por favor...', css: { 
            border: 'none', 
            padding: '15px', 
            backgroundColor: '#000', 
            '-webkit-border-radius': '10px', 
            '-moz-border-radius': '10px', 
            opacity: .5, 
            color: '#fff' 
        } }); 

    }

    $('.responder_pregunta').click(function()
    {  
        var _action = 'R';
        var _id = $(this).attr('data-id');
        var _texto = $('#text_area_respuesta_'+_id).val();
        var param = { 'action':_action,'texto':_texto,'id': _id };               
        

        if(_texto == '' || typeof(_texto) == 'undefined')
        {
            _control = $(this).attr('data-control');
            swal('La casilla de respuesta no puede estar vacia.');    
            return;  
        }

        
        bloqueoPantalla();
        
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('GestionDeudas/OperacionMensajes')."',
            type:       'POST',
            data:       param,
            dataType:   'JSON',
            success:    function(_res)
            {
                desbloquePantalla();
                if(_res.status)
                {
                    window.location.reload();
                }
                else
                {
                    swal(_res.mensaje);  
                }
            },
            error: function(_error)
            {
                desbloquePantalla();
                swal('Se produjó un error al intentar procesar los datos.');
            }
        }); 

        return false;
    });


    function desbloquePantalla()
    {
        $(document).ready(function() 
        {
            $.unblockUI({
                onUnblock: function(){
                }
            });
        });
    }

");
?>
<!-- Start Row -->  
<div class="row">    
    <?php 
    $rows = $model->getPreguntasDeudas();
    if(!is_null($rows)):
    ?>
        <?php 
        foreach($rows as $key=>$value):
        
        //$usuario = $value->getInfoUsuario($value->documento); 
        ?>
        <div class="col-md-10">
            <div class="panel panel-primary">
                <div class="panel-body">
                    <h4 class="m-t-0 m-b-30">
                    <?php 
                    echo $value->iddeudahistorico0->documento." - ".$value->iddeudahistorico0->nroproducto." - ". $value->iddeudahistorico0->monto_total;
                    ?>
                    </h4>
                    
                    <ul class="list-group">
                        <li class="list-group-item disabled">
                            <?php 
                            echo $value->pregunta;
                            ?>
                        </li>
                        <li class="list-group-item">
                        	<?php 
                        	if(!empty($value->respuesta)):
                        	   echo $value->respuesta;
                        	else:
                        	?>
                        		<div class="form-group">
                                    <div>
                                        <textarea name="text_area_respuesta" id="text_area_respuesta_<?php echo $value->id;?>" class="form-control" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                	<a href="#" data-id="<?php echo $value->id;?>" class="btn btn-primary responder_pregunta" >
                                  		Responder
                                  	</a>
                                </div>
                        	<?php 
                        	endif;
                        	?>
                        </li>
                    </ul>
                </div>  <!-- end panel-body -->
            </div> <!-- panel -->
        </div> 
        <!-- End Row --> 
        <?php 
        endforeach;
        ?>
	<?php 
	endif;
	?>
</div>       
<div class="modal bs-example-modal" id="modalImportar" tabindex="-1" role="dialog"></div> 
                   