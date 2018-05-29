<?php
/* @var $this PanelUsuariosController */
/* @var $model UsrDeudas */
/* @var $form CActiveForm */ 

include('accionesjs.php');
?>
<div class="card-body">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usr-usuarios-pregunta',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>  
  
  <?php 
	/*
	 * Pregunta 5
	 * */
	
	?>
  <div class="form-group">
    <div class="form-row">
      <div class="col-md-12">
        <h5><?php echo $model->validacion5_pregunta; ?></h5>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-11">            
        	<?php 
        	if(isset($model->validacion5_respuesta_erronea_2)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="1" name="UsrDeudas[respuesta1]">
                  	<?php echo $model->validacion5_respuesta_erronea_2;?>
                  </label>
                  <input type="hidden" id="action" name="action" value="<?php echo isset($patron)? $patron : ''; ?>">
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion5_respuesta_valida)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="2" name="UsrDeudas[respuesta1]">
                  	<?php echo $model->validacion5_respuesta_valida;?>
                  </label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion5_respuesta_erronea_4)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="3" name="UsrDeudas[respuesta1]">
                  <?php echo ($model->validacion5_respuesta_erronea_4)? $model->validacion5_respuesta_erronea_4: "Ninguna";?>
                  </label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion5_respuesta_erronea_3)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="4" name="UsrDeudas[respuesta1]"><?php echo $model->validacion5_respuesta_erronea_3;?></label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion5_respuesta_erronea_1)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="5" name="UsrDeudas[respuesta1]"><?php echo $model->validacion5_respuesta_erronea_1;?></label>
                </div>
            <?php 
            endif;
            ?>
      </div>
    </div>
  </div> 
	<?php 
	/*
	 * Pregunta 1
	 * */
	
	?>
  <div class="form-group">
    <div class="form-row">
      <div class="col-md-12">
        <h5><?php echo $model->validacion1_pregunta; ?></h5>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-11">            
        	<?php 
            if(isset($model->validacion1_respuesta_erronea_2)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="4" name="UsrDeudas[respuesta2]"><?php echo $model->validacion1_respuesta_erronea_2;?></label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion1_respuesta_erronea_1)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="2" name="UsrDeudas[respuesta2]"><?php echo $model->validacion1_respuesta_erronea_1;?></label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion1_respuesta_erronea_4)):
            ?>
                <div class="radio">
                  <label>
                  	<input type="radio" value="3" name="UsrDeudas[respuesta2]">
                  	<?php echo ($model->validacion1_respuesta_erronea_4)? $model->validacion1_respuesta_erronea_4: "Ninguna";?>
                  </label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion1_respuesta_erronea_3)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="4" name="UsrDeudas[respuesta2]"><?php echo $model->validacion1_respuesta_erronea_3;?></label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion1_respuesta_valida)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="5" name="UsrDeudas[respuesta2]">
                  <?php echo $model->validacion1_respuesta_valida;?>
                  </label>
                </div>
            <?php 
            endif;
            ?>
      </div>
    </div>
  </div> 
  
  <?php 
	/*
	 * Pregunta 3
	 * */
	
	?>
  <div class="form-group">
    <div class="form-row">
      <div class="col-md-12">
        <h5><?php echo $model->validacion3_pregunta; ?></h5>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-11">            
        	<?php 
            if(isset($model->validacion3_respuesta_erronea_2)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="1" name="UsrDeudas[respuesta3]">
                  	<?php echo $model->validacion3_respuesta_erronea_2;?>
                  </label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion3_respuesta_erronea_3)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="2" name="UsrDeudas[respuesta3]"><?php echo $model->validacion3_respuesta_erronea_3;?></label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion3_respuesta_erronea_1)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="3" name="UsrDeudas[respuesta3]">
                  <?php echo $model->validacion3_respuesta_erronea_1;?>
                  </label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion3_respuesta_valida)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="4" name="UsrDeudas[respuesta3]"><?php echo $model->validacion3_respuesta_valida;?></label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion3_respuesta_erronea_4)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="5" name="UsrDeudas[respuesta3]">
                  <?php echo ($model->validacion3_respuesta_erronea_4)? $model->validacion3_respuesta_erronea_4: "Ninguna";?>
                  </label>
                </div>
            <?php 
            endif;
            ?>
      </div>
    </div>
  </div>  
  
  <?php 
	/*
	 * Pregunta 4
	 * */
	
	?>
  <div class="form-group">
    <div class="form-row">
      <div class="col-md-12">
        <h5><?php echo $model->validacion4_pregunta; ?></h5>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-11">            
        	<?php 
            if(isset($model->validacion4_respuesta_erronea_4)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="1" name="UsrDeudas[respuesta4]">
                  	<?php echo ($model->validacion4_respuesta_erronea_4)? $model->validacion4_respuesta_erronea_4: "Ninguna";?>
                  </label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion4_respuesta_erronea_2)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="2" name="UsrDeudas[respuesta4]"><?php echo $model->validacion4_respuesta_erronea_2;?></label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion4_respuesta_valida)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="3" name="UsrDeudas[respuesta4]">
                  <?php echo $model->validacion4_respuesta_valida;?>
                  </label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion4_respuesta_erronea_1)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="4" name="UsrDeudas[respuesta4]"><?php echo $model->validacion4_respuesta_erronea_1;?></label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion4_respuesta_erronea_3)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="5" name="UsrDeudas[respuesta4]"><?php echo $model->validacion4_respuesta_erronea_3;?></label>
                </div>
            <?php 
            endif;
            ?>
      </div>
    </div>
  </div> 
  
  <?php 
	/*
	 * Pregunta 2
	 * */
	
	?>
  <div class="form-group">
    <div class="form-row">
      <div class="col-md-12">
        <h5><?php echo $model->validacion2_pregunta; ?></h5>
      </div>
      <div class="col-md-1"></div>
      <div class="col-md-11">            
        	<?php 
        	if(isset($model->validacion2_respuesta_valida)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="1" name="UsrDeudas[respuesta5]">
                  	<?php echo $model->validacion2_respuesta_valida;?>
                  </label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion2_respuesta_erronea_4)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="2" name="UsrDeudas[respuesta5]">
                  	<?php echo ($model->validacion2_respuesta_erronea_4)? $model->validacion2_respuesta_erronea_4: "Ninguna";?>
                  </label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion2_respuesta_erronea_2)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="3" name="UsrDeudas[respuesta5]"><?php echo $model->validacion2_respuesta_erronea_2;?></label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion2_respuesta_erronea_1)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="4" name="UsrDeudas[respuesta5]"><?php echo $model->validacion2_respuesta_erronea_1;?></label>
                </div>
            <?php 
            endif;
            ?>
            <?php 
            if(isset($model->validacion2_respuesta_erronea_3)):
            ?>
                <div class="radio">
                  <label><input type="radio" value="5" name="UsrDeudas[respuesta5]"><?php echo $model->validacion2_respuesta_erronea_3;?></label>
                </div>
            <?php 
            endif;
            ?>
      </div>
    </div>
  </div>
  
  <div class="form-group">
    <div class="form-row">
      <div class="col-md-10"></div>
      <div class="col-md-2">
      	<?php echo CHtml::submitButton('Validar',array('class'=>'btn btn-primary btn_validar_usuario','id'=>'validacion4_respuesta_erronea_4')); ?>
      </div>
   	</div>
  </div>  
<?php $this->endWidget(); ?>
</div>