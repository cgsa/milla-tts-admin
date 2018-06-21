<div class="container">    
    
    <div class="row" >
    	<div class="col-lg-12">
            <div class="panel panel-fill panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Bienvenido al sistema administrativo de Millas TTS Viajes</h3>
                </div>
                <div class="panel-body">
                    <p>Millas tts, es un sistema de financiamiento de boletos de avión a cualquier destino en Sur America.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
    
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <div class="panel text-center">
                <div class="panel-heading">
                    <h4 class="panel-title text-muted font-light">Usuarios Activos</h4>
                </div>
                <div class="panel-body p-t-10">
                    <h2 class="m-t-0 m-b-15">
                    	<?php 
                    	$criteria=new CDbCriteria;
                    	$criteria->select =" count(id) AS id_user";
                    	$criteria->condition ="estadousuario = 1";
                    	$user = UsuarioSistema::model()->find($criteria);
                    	?>
                    	<i class="mdi mdi-account-outline text-primary m-r-10"></i><b><?php echo $user->id_user;?></b>
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel text-center">
                <div class="panel-heading">
                    <h4 class="panel-title text-muted font-light">Suscripciones</h4>
                </div>
                <div class="panel-body p-t-10">
                    <h2 class="m-t-0 m-b-15">
                    	<?php 
                    	$criteria=new CDbCriteria;
                    	$criteria->select =" count(id) AS suscriptos";
                    	$criteria->condition ="status = 1";
                    	$suscripciones = Suscripciones::model()->find($criteria);
                    	?>
                    	<i class="mdi mdi-contact-mail text-primary m-r-10"></i><b><?php echo $suscripciones->suscriptos;?></b>
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel text-center">
                <div class="panel-heading">
                    <h4 class="panel-title text-muted font-light">Promociones Compradas</h4>
                </div>
                <div class="panel-body p-t-10">
                    <h2 class="m-t-0 m-b-15">
                    	<?php 
                    	$criteria=new CDbCriteria;
                    	$criteria->select =" count(id) AS compras";
                    	$criteria->condition ="status = 1";
                    	$uCompras = PromocionUsuario::model()->find($criteria);
                    	?>
                    	<i class="mdi mdi-credit-card text-primary m-r-10"></i><b><?php echo $uCompras->compras;?></b>
                    </h2>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-lg-3">
            <div class="panel text-center">
                <div class="panel-heading">
                	<?php 
                	$criteria=new CDbCriteria;
                	$criteria->select =" count(id) AS pagos";
                	$criteria->condition ="status = 1";
                	$pagos = PagosPromociones::model()->find($criteria);
                	?>
                    <h4 class="panel-title text-muted font-light">Cupones Pagos</h4>
                </div>
                <div class="panel-body p-t-10">
                    <h2 class="m-t-0 m-b-15">
                    	<i class="mdi mdi-briefcase-check text-danger m-r-10"></i><b><?php echo $pagos->pagos;?></b>
                    </h2>
                </div>
            </div>
        </div>
    </div>
    
    
</div>