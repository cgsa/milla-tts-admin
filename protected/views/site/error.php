<?php
/* @var $this SiteController */
/* @var $error array */


function textError()
{
    return array(
        '404'=>'Disculpe, no se ha encontrado la vista solicitada!',
        '401'=>'No tiene autorización para acceder a esta vista!',
        '500'=>'Disculpe, se produjo un error en el servidor!'
    );
}
?>


<!-- Begin page -->
<div class="accountbg"></div>
<div class="wrapper-page">
    <div class="ex-page-content text-center">
        <h1 class="text-white"><?php echo $code; ?>!</h1>
        <h2 class="text-white">
        	<?php 
            	$pageError = textError();
            	echo $pageError[$code];
        	?>
        </h2><br>

        <a class="btn btn-info waves-effect waves-light" href="<?php echo Yii::app()->createUrl("/site/Login");?>">Volver</a>
    </div>
</div>