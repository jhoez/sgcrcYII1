<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="language" content="es">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/sweetalert2/dist/sweetalert2.min.css">
	<!-- Materialize -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/materialize/css/materialize.min.css" media="screen,projection">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<script type="text/javascript">
	//document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('load', function(){
			// EVENTO PARA BOTON DE LOGOUT
			var logout = document.getElementById('uexit');
			logout.addEventListener('click', function(e) {
				e.preventDefault();
			    Swal.fire({
			        title: '¿Esta seguro en Cerrar la Session?',
			        //text: "You won't be able to revert this!",
			        icon: 'info',
			        showCancelButton: true,
			        confirmButtonColor: '#3085d6',
			        confirmButtonText: 'ACEPTAR',
			        cancelButtonColor: '#d33',
			        cancelButtonText: 'CANCELAR'
			    }).then((result) => {
			        if (result.value) {
			            document.location="<?php echo Yii::app()->baseUrl; ?>/index.php/cruge/ui/logout";
			        } else if (result.value == 'undefined') {
			            Swal.fire(
			                '¡Cierre de Session Cancelada!',
			                '',
			                'success'
			            );
			        }
			    });
			});

			// TIEMPO EXPIRACION DE SESSION
			function cerrarSesion() {
			    let timerInterval;
			    Swal.fire({
			        icon: 'info',
			        title: '¡Tu Session a expirado!',
			        html: 'Se cerrara la Session en <strong></strong> ms.',
			        timer: 10000, //tiempo del timer
			        onBeforeOpen: () => {
			            Swal.showLoading();
			            timerInterval = setInterval(() => {
			                Swal.getContent().querySelector('strong').textContent = Swal.getTimerLeft()
			            }, 100);
			        },
			        onClose: () => {
			            clearInterval(timerInterval);
						document.location="<?php echo Yii::app()->baseUrl; ?>/index.php/cruge/ui/logout";
			        }
			    }).then((result) => {
			        if (result.dismiss === Swal.DismissReason.timer) { // Read more about handling dismissals
			            console.log('Sera Cerrado por tiempo inactivo');
			        }
			    });
			}

            <?php if( !Yii::app()->user->isGuest ){?>
                url = "<?php echo Yii::app()->baseUrl; ?>/index.php/site/tiempoSesion";
                respuesta = consultarPHP(url,'',"html");
                tiempo = respuesta * 60000;

                setTimeout( cerrarSesion,tiempo );
            <?php }?>
        });
    </script>
</head>
<body>
<div class="container">
	<div id="bannertop">
		<?php echo CHtml::image(Yii::app()->baseUrl."/img/bannerfundabit.png", 'banner'); ?>
	</div>

	<nav class="blue darken-2">
		<div id="nav-wrapper">
			<?php $this->widget('zii.widgets.CMenu',array(
				'id'=>'nav-mobile',
				'encodeLabel'=>false,
				'items'=>array(
					array(
						'label'=>"Inicio<i class='tiny material-icons left'>home</i>",
						'url'=>array('/site/index'),
						'visible' => Yii::app()->user->isGuest ||
						(
							Yii::app()->user->checkAccess('administrator' ) ||
							Yii::app()->user->checkAccess('tutor')
						)
					),
					array(
						'label'=>"Contenido Educativo",
						'url'=>array('/libros/index'),
						'visible' => Yii::app()->user->isGuest ||
						(
							Yii::app()->user->checkAccess('administrator' ) ||
							Yii::app()->user->checkAccess('tutor')
						),
						//'linkOptions'=>array('style'=>'background-color:#ffeb3b;')
					),
					array(
						'label'=>'Proyectos Digitales',
						'url'=>array('/multimedia/index'),
						'visible' => Yii::app()->user->isGuest ||
						(
							Yii::app()->user->checkAccess('administrator' ) ||
							Yii::app()->user->checkAccess('tutor')
						),
						//'linkOptions'=>array('style'=>'background-color:#2196f3;')
					),
					array(
						'label'=>'Realidad aumentada',
						'url'=>array('/realaum/index'),
						'visible' => Yii::app()->user->isGuest ||
						(
							Yii::app()->user->checkAccess('administrator' ) ||
							Yii::app()->user->checkAccess('tutor')
						),
						//'linkOptions'=>array('style'=>'background-color:#f44336;')
					),
					array(
						'label'=>'Tutor',
						'url' => array('/equipo/index'),
						'visible' => !Yii::app()->user->isGuest &&
									(
										Yii::app()->user->checkAccess('administrator' ) ||
										Yii::app()->user->checkAccess('tutor')
									)
					),
					array(
						'label'=>"Administrar Usuario",
						'url'=> Yii::app()->user->ui->userManagementAdminUrl,
						'visible' => Yii::app()->user->checkAccess('administrator' )
					),
					array(
						'label'=>'Entrar',
						'url'=>array('/cruge/ui/login'),
						'visible' => Yii::app()->user->isGuest
					),
					array(
						'label'=>'Salir',
						'url'=>array('/cruge/ui/logout'),
						'visible' => !Yii::app()->user->isGuest,
						'linkOptions' => array('id'=>'uexit')
					)
				),
				'htmlOptions' => array('class'=>'hide-on-med-and-down'),
			)); ?>
		</div><!-- nav-wrapper -->
	</nav>

	<?php if (!Yii::app()->user->isGuest) {?>
		<?php if(isset($this->breadcrumbs)):?>
			<?php $this->widget('zii.widgets.CBreadcrumbs', array(
				'links'=>$this->breadcrumbs,
			)); ?>
		<?php endif; ?>
	<?php }?>

	<?php echo $content; ?>

	<?php //echo Yii::app()->user->ui->displayErrorConsole();  ?>

	<footer class="page-footer blue darken-2">
		<div class="row">
			<div class="col l4 offset-l2 s12">
				<p class="white-text">
					 Esq. de Salas a Caja de Agua, Edif.
					 Sede del Ministerio del Poder Popular para la Educación (MPPE),
					 Parroquia Altagracia, Dtto. Capital, Caracas- Venezuela,
					 Teléfonos: (+58-212) 506.88.15 - RIF: G-20003142-5
				</p>
			</div>
			<div class="col l4 offset-l2 s12">
				<h5 class="black-text">Fundabit</h5>
				<ul>
					<li><?php echo CHtml::link('Misión y Vision',array('site/mv'), array('class'=>'white-text') ); ?></li>
					<li><?php echo CHtml::link('Objetivos',array('site/obj'), array('class'=>'white-text') ); ?></li>
					<li><?php echo CHtml::link('Valores',array('site/v'), array('class'=>'white-text') ); ?></li>
				</ul>
			</div>
		</div>
		<div class="footer-copyright">
			<div class="container">
				<h6 class="white-text center-align">© Copyright &copy; <?php echo date('Y'); ?> by jhon. All Rights Reserved.</h6>
			</div>
		</div>
	</footer>
</div>

<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/librerias.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/sweetalert2/dist/sweetalert2.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/css/materialize/js/materialize.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.dropdown-trigger').dropdown();
		$('.tabs').tabs();
		$('.sidenav').sidenav();
		$('.datepicker').datepicker();
		M.updateTextFields();
		//$('select').formSelect();
	});

	document.addEventListener('DOMContentLoaded', function() {
		var elems = document.querySelectorAll('.fixed-action-btn');
		var instances = M.FloatingActionButton.init(elems, {
			direction: 'right'
		});
	});
</script>
</body>
</html>
