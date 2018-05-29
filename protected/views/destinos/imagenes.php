<?php
/* @var $this ImagenesController */
/* @var $model Imagenes */

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl."/assets/uploadifive/jquery.uploadifive.min.js", CClientScript::POS_END);
Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/assets/uploadifive/uploadifive.css');

$timestamp = time();
$clave = md5('unique_salt' .$timestamp);

Yii::app()->clientScript->registerScript('search', "
    
$(function() {
	$('#file_upload').uploadifive({
		'auto'             : true,
		//'checkScript'      : '".Yii::app()->createUrl('imagenes/CheckFile')."',
        'fileObjName'      : 'Imagenes[Filedata]',
		'formData'         : {
							   'timestamp' : '".$timestamp."',
							   'token'     : '".$clave."'
		                     },
		'queueID'          : 'queue',
		'uploadScript'     : '".Yii::app()->createUrl('Destinos/Upload',array('id'=>$id))."',
		'onUploadComplete' : function(file, data)
                             {
                                location.reload();
                             }
	});
});
    
    
$('.b_formulario').click(function()
{
    var action = $(this).attr('data-action');
    var id = $(this).attr('data-id');
    var destino = $(this).attr('data-destino');
    var _param = {'action':action,'id':id,'destino':destino};
    
    $.ajax(
    {
        url:   '".Yii::app()->createUrl('Destinos/Formulario')."',
        type:  'POST',
        data:  _param,
        dataType: 'JSON',
        success: function(_res)
        {
            desbloquePantalla();
            if(_res.status)
            {
                $('#modalImportar').html(_res.formulario);
                $('#modalImportar').modal({show:true,keyboard: false});
            }
            else
            {
                swal(_res.mensaje);
            }
        },
        error: function(_error)
        {
            desbloquePantalla();
            swal( 'Se produjó un error en el procesamiento los datos.' );
        }
    
    });
});
    
$('body').delegate('.btn-operaciones','click',function()
{
    
    var action = $(this).attr('data-action');
    var id = $(this).attr('data-id');
    var destino = $(this).attr('data-destino');
    var _param = {'action':action,'id':id,'destino':destino};
    
    $.ajax(
    {
        url:        '".Yii::app()->createUrl('Destinos/Registrar')."',
        type:       'POST',
        data:       _param,
        dataType:   'JSON',
        success:    function(_res)
        {
            desbloquePantalla();
            if(_res.status)
            {
                location.reload();
            }
            else
            {
                swal( _res.mensaje );
            }
        },
        error: function(_error)
        {
            desbloquePantalla();
            swal( 'Se produjó un error en el procesamiento los datos.' );
        }
    });
    
    return false;
});



$('body').delegate('.btn-procesar-datos','click',function()
{    
    var action = $(this).attr('data-action');
    var id = $(this).attr('data-id');
    var destino = $(this).attr('data-destino');
    var _url = '".Yii::app()->createUrl('Imagenes/Registrar')."';
    var _param = {'action':action,'id':id,'destino':destino};
    
    enviarDatos( _param, _url );
    
    return false;
});


$('body').delegate('.btn-procesar-formulario','click',function()
{    
    var _url = '".Yii::app()->createUrl('Destinos/Registrar')."';
    var _param = $('#formulario-form').serialize();
    
    enviarDatos( _param, _url );
    
    return false;
});


function enviarDatos( param, url )
{
    $.ajax(
    {
        url:        url,
        type:       'POST',
        data:       param,
        dataType:   'JSON',
        success:    function(_res)
        {
            desbloquePantalla();
            if(_res.status)
            {
                swal( _res.mensaje );
                location.reload();
            }
            else
            {
                swal( _res.mensaje );
            }
        },
        error: function(_error)
        {
            desbloquePantalla();
            swal( 'Se produjó un error en el procesamiento los datos.' );
        }
    });

}
    
    
        
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

<?php 
$baseUrl = Yii::app()->request->baseUrl;
?>
<!-- Start Row --> 
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
            	<div class="row">
                	<div class="col-xs-6 col-sm-4 m-b-30">
                        <div class="btn-group">
                            <form>
                            	<div class="col-xs-6 col-sm-5 m-b-30">
                            		<input id="file_upload" name="file_upload" type="file" multiple="true">                            		
                            	</div>
                            	<div class="col-xs-6 col-sm-5 m-b-30">
                            		<div id="queue"></div>
                            	</div>   	
                            </form>                                                              
                        </div>
                    </div>
                </div>
            	<div class="row" >
            		<?php               	
                  	$criteria=new CDbCriteria;
                  	$criteria->join = "LEFT JOIN imagenes i ON t.id_imagen = i.id";
                  	$criteria->condition = "t.id_destino = ".$id;
                  	$criteria->order = "t.id DESC";          	
                  	
                  	$rows = $model->findAll($criteria);
                  	foreach ($rows as $key =>$value): 
                  	?>
                      	<div class="col-md-3 text-center" >
                      		<div class="col-md-12" style="height: 150px;">
                      			<img width="60%" src="<?php echo $baseUrl."/upload/img/".$value->idImagen->path;?>" />
                      		</div>
                      		<div class="col-md-12">
                      			<a data-destino="<?php echo $id;?>" data-action="B" data-id="<?php echo $value->idImagen->id;?>" title="Crear Banner" class="b_formulario" style="cursor: pointer;" >
                      				<i class="fa fa-bars"></i>
                      			</a>
                      			<a data-destino="<?php echo $id;?>" data-action="P" data-id="<?php echo $value->id;?>" title="Marcar como principal" class="btn-operaciones" style="cursor: pointer;" >
                      				<?php 
                      				if($value->es_principal == 0):
                      				?>
                      				<i class="fa fa-flag-o"></i>
                      				<?php 
                      				else:
                      				?>
                      					<i class="fa fa-star-o"></i>
                      				<?php 
                      				endif;
                      				?>
                      			</a>                      			
                      		</div>
                        </div>                        
    				<?php 				
    				endforeach;
    				?>
            	</div>	              	
            </div>
        </div>
    </div>

</div> <!-- End row -->
<div class="modal fade" id="modalImportar" tabindex="-1" role="dialog"></div>

