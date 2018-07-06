<?php
/* @var $this DestinosController */
/* @var $model Destinos */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScriptFile( 'http://www.openlayers.org/api/OpenLayers.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('destinos', "
    
$('.wysihtml5').wysihtml5();


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


  var map;
  var centrar = '".$model->coodenadas."';
  
  if( centrar == '' || centrar == null )
  {
     centrar = '-6501218.4158308,-4110889.0871958';
  } 

  var coor = centrar.split(',');   


  function crearMapa() 
  {
        // apaño para modificar el estilo de texto de la atribución
        var S = document.createElement('style');
        S.type = 'text/css';
        var T = '.olControlAttribution {bottom: 0 !important;}';
        T = document.createTextNode(T)
        S.appendChild(T);
        document.body.appendChild(S);
        // Creación de un mapa
        map = new OpenLayers.Map('basicMap');
        // Creación de la capa que muestra el mapa de openstreetmap
        var mapnik = new OpenLayers.Layer.OSM();
        // Muestra imagenes pixeladas mientras se hace zum
        mapnik.transitionEffect = 'resize';

        // Evento click.
		    map.events.register('click', map, function(e){
			var position = map.events.getMousePosition(e);
			var lonlat = map.getLonLatFromPixel(position);
            $('#Destinos_coodenadas').val(lonlat.lon+', '+lonlat.lat);
			centrarClick(lonlat.lon, lonlat.lat);
		});

        // Añadir la capa al mapa
        map.addLayer(mapnik);
        //web para sacar coordenadas
        //http://www.gorissen.info/Pierre/maps/googleMapLocationv3.php
        // Centrar el mapa transformando las coordenadas
        map.setCenter(new OpenLayers.LonLat(coor[0], coor[1] ), 10 );

        /*
            
          .transform(
            new OpenLayers.Projection('EPSG:4326'), // de WGS 1984
            new OpenLayers.Projection('EPSG:900913') // a Proyección Esférica Mercator
          )

        */
  }

  function centrarClick( lon, lat) 
  {

        map.setCenter(new OpenLayers.LonLat(lon,lat), 10 // Nivel de zum
        );
    /*map.addPopup(new  OpenLayers.Popup.FramedCloud(
                            'La pilarica',
                             new OpenLayers.LonLat(-0.878756,41.656717)
          .transform(
            new OpenLayers.Projection('EPSG:4326'), // de WGS 1984
            new OpenLayers.Projection('EPSG:900913')),
          null,
          '<img src=\'http://t1.gstatic.com/images?q=tbn:KWchVEJywTCKcM:http://upload.wikimedia.org/wikipedia/commons/5/58/Basilica_del_Pilar_ZaragozaAragon%28Spain%29.jpg\' alt=\'pilarica\' />',
          null,
          true
    ));*/

  }

$(document).ready(function()
{
    crearMapa();
});
    
");
?>

<!-- Start Row -->  
<div class="row">
	<!-- Horizontal form -->
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-body">
                <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'destinos-form',
                    'action'=> '',
                    'method'=> 'post',
                	// Please note: When you enable ajax validation, make sure the corresponding
                	// controller action is handling ajax validation correctly.
                	// There is a call to performAjaxValidation() commented in generated controller code.
                	// See class documentation of CActiveForm for details on this.
                    'enableAjaxValidation'=>false,
                    'htmlOptions' => array('class'=>'form-horizontal'),
                )); ?>
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'ciudad',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">                            
                            <?php echo $form->textField($model,'ciudad',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
							<?php echo $form->error($model,'ciudad'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'nombre',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model,'nombre',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
							<?php echo $form->error($model,'nombre'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php echo $form->labelEx($model,'coodenadas',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textField($model,'coodenadas',array('class'=>'form-control','size'=>60,'maxlength'=>100)); ?>
							<?php echo $form->error($model,'coodenadas'); ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    	<?php echo $form->labelEx($model,'descripcion',array('class'=>'col-sm-3 control-label')); ?>
                        <div class="col-sm-9">
                            <?php echo $form->textArea($model,'descripcion',array('class'=>'form-control wysihtml5','rows'=>9)); ?>
                			<?php echo $form->error($model,'descripcion'); ?>
                        </div>                		
                    </div>
                    <div class="form-group" >
                    	<?php echo $form->labelEx($model,'status',array('class'=>'col-sm-3 control-label')); ?>
                    	<div class="col-sm-9">
                    		<?php 
                    		echo $form->dropDownList($model,'status',array('1' => 'Activo', '0' => 'Inactivo'),
                    		          array('empty' => '--Seleccione--','class'=>'form-control'));
                    		?>
                    		<?php echo $form->error($model,'status'); ?>
                    	</div>
                    </div>
                    <div class="form-group" >
                    	<div class="col-sm-3"></div>
                    	<div class="col-sm-9" id="basicMap" style="width: 550px;height: 300px;margin: 0;">
                    	</div>
                    </div>                 
                    <div class="form-group m-b-0">
                        <div class="col-sm-offset-3 col-sm-9">
                        	<a href="<?php echo Yii::app()->createUrl("/Destinos/admin");?>"  class="btn btn-danger" >Volver</a>
                            <button type="submit" class="btn btn-info waves-effect waves-light">Registrar</button>
                        </div>
                    </div>
                <?php $this->endWidget(); ?>
            </div> <!-- panel-body -->
        </div> <!-- panel -->
    </div> <!-- col -->
</div>
<!-- End Row -->

