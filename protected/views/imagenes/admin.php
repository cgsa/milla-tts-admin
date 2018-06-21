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
		'uploadScript'     : '".Yii::app()->createUrl('imagenes/Upload')."',
		'onUploadComplete' : function(file, data) 
                             { 
                                location.reload();
                             }
	});
});


$('.cls_nombrar').click(function()
{
    var _id = $(this).attr('data-id');
    var _param = {'id':_id, 'action':'N'};

    $.ajax(
    {
        url:   '".Yii::app()->createUrl('Imagenes/Formulario')."',
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


$('.btn-dialogo-galeria').click(function()
{
    
    var _ids = [];

    $('.chk_imagenes').each(function(i,obj)
    {
        if($(obj).prop('checked'))
        {
            _ids.push($(obj).attr('data-id')); 
        }
    });
    
    

    if(_ids.length == 0)
    {
        swal('Debe tildar el checkbox de una imagen para crear una galeria');
        return false;
    }
    
    var _action = $(this).attr('data-action');
    var _param = {'ids':'','action':_action};
    _param.ids = _ids;

    $.ajax(
    {
        url:   '".Yii::app()->createUrl('Imagenes/Formulario')."',
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



$('body').delegate('.bt-operaciones', 'click', function()
{
    var action = $(this).attr('data-action');
    var id = $(this).attr('data-id');
    var _param = {'action':action, 'id':id};   
    
    swal({
        title: 'Está seguro?',
        text: 'De querer realizar esta operación!',
        type: 'warning',
        confirmButtonClass: 'btn-warning',
        showCancelButton: true,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        closeOnConfirm: true
    }, function () 
    {
        bloqueoPantalla();
        $.ajax(
        {
            url:        '".Yii::app()->createUrl('Imagenes/Registrar')."',
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
                    swal('No se ha podido completar la acción');
                }
            },
            error: function(_error)
            {
                desbloquePantalla();
                swal( 'Se produjó un error en el procesamiento los datos.' );
            }
    
        }); 

    });
    
    return false;
    
});



$('body').delegate('.btn-procesar-datos','click',function()
{

    var param = $('#imagenes-form').serialize();  
    bloqueoPantalla();
    
    enviarParam(param);

    return false;
});



function enviarParam(param)
{

    $.ajax(
    {
        url:        '".Yii::app()->createUrl('Imagenes/Registrar')."',
        type:       'POST',
        data:       param,
        dataType:   'JSON',
        success:    function(_res)
        {
            desbloquePantalla();
            if(_res.status)
            {                   
                swal( _res.mensaje );
                //location.reload();
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

<h1>Manage Imagenes</h1>



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
                  	$criteria->join = "LEFT JOIN galeria_promocion gp ON gp.id_imagen = t.id"; 
                  	$criteria->join .= " LEFT JOIN galeria_destino gd ON gd.id_imagen = t.id"; 
                  	$criteria->condition = "gp.id_imagen IS NULL AND gd.id_imagen IS NULL"; 
                  	$criteria->order = "id DESC";          	
                  	
                  	$rows = $model->findAll($criteria);
                  	foreach ($rows as $key =>$value): 
                  	?>
                      	<div class="col-md-3 text-center m-b-10" >
                      		<div class="col-md-12" style="height: 150px;">
                      			<img width="60%" src="<?php echo $baseUrl."/upload/img/".$value->path;?>" />
                      		</div>
                      		<div class="col-md-12">
                      			<input data-id="<?php echo $value->id;?>" type="checkbox" name="chk_imagenes[]" class="chk_imagenes" />
                      			<a data-id="<?php echo $value->id;?>" class="cls_nombrar" style="cursor: pointer;" ><i class="fa fa-bars"></i></a>
                      			<a data-id="<?php echo $value->id;?>" class="bt-operaciones" data-action="E" style="cursor: pointer;" ><i class="fa fa-trash"></i></a>                      			
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

