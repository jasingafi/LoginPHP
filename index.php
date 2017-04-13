<?php
include("conexion.php");
session_start();
if (isset($_SESSION['id_usuario'])) {
   header("Location: admin.php");
}
if (!empty($_POST)) {
   $usuario = mysqli_real_escape_string($conexion, $_POST['user']);
   $password = mysqli_real_escape_string($conexion, $_POST['pass']);
   $enc_pass = sha1($password);
   $sql = "SELECT idusuarios, id_tipousuario FROM usuarios
            WHERE  usuario='$usuario' AND password='$enc_pass'";
    $resultado = $conexion->query($sql);
    $rows = $resultado->num_rows;
    if ($rows>0) {
        $row = $resultado->fetch_assoc();
        $_SESSION['id_usuario'] = $row['idusuarios'];
        $_SESSION['tipo_usuario']= $row['id_tipousuario'];
        header("Location: admin.php");
    }else{
        $error = "Usuario o password incorrecto ";
    }
}
//registro usuarios


if (isset($_POST["registrar"])) {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $identidad = mysqli_real_escape_string($conexion, $_POST['identidad']);
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $usuario = mysqli_real_escape_string($conexion, $_POST['user']);
    $password = mysqli_real_escape_string($conexion, $_POST['pass']);
    $tipouser = $_POST['tipo_user'];
    $enc_pass = sha1($password);

    $sqluser = "SELECT idusuarios FROM usuarios WHERE usuario ='$usuario'";
    $resultadouser = $conexion->query($sqluser);
    $filas = $resultadouser->num_rows;
        if ($filas>0) {
            //$msj = "El usuario ya existe ";
            echo "<script>
                    alert('El usuario ya existe ');
                    window.location='index.php';
                    </script>";
        }else{
            $sqlalumno = "INSERT INTO alumnos (Identidad, Nombre, Telefono, Correo) VALUES ('$identidad','$nombre','$telefono','$correo')";
            $reultadoalumno =$conexion->query($sqlalumno);
           // mysqli_query($conex,$consulta);
           $idalumno = $conexion->insert_id;

           //Insertamos los datos del usuario
           $sqlusuario = "INSERT INTO usuarios (usuario, password, id_alumno, id_tipousuario) VALUES ('$usuario','$enc_pass', '$idalumno','$tipouser' )";
           $resultadousuario = $conexion->query($sqlusuario);
           if ($resultadousuario > 0) {
               //$ucenm = true;
             echo "<script>
                    alert('Registro Exitoso ');
                    window.location='index.php';
                    </script>";
           }else{
             echo "<script>
                    alert('Error alregistrarse ');
                    window.location='index.php';
                    </script>";
           }

        }
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Login  - Sistema de Usuarios</title>

		<meta name="description" content="User login page" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.min.css" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="login-layout">
		<div class="main-container">
			<div class="main-content">
				<div class="row">
					<div class="col-sm-10 col-sm-offset-1">
						<div class="login-container">
							<div class="center">
								<h1>
									<i class="ace-icon fa fa-leaf green"></i>
									<span class="red">Sistema </span>
									<span class="white" id="id-text2">de Usuarios</span>
								</h1>
								<h4 class="blue" id="id-company-text">&copy; SETC</h4>
							</div>

							<div class="space-6"></div>

							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="ace-icon fa fa-coffee green"></i>
												Ingresa tu Informacion
											</h4>

											<div class="space-6"></div>

											<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" >
												<fieldset>
													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="text" class="form-control"  name="user"placeholder="Username" />
															<i class="ace-icon fa fa-user"></i>
														</span>
													</label>

													<label class="block clearfix">
														<span class="block input-icon input-icon-right">
															<input type="password" name="pass"class="form-control" placeholder="Password" />
															<i class="ace-icon fa fa-lock"></i>
														</span>
													</label>

													<div class="space"></div>

													<div class="clearfix">
														<label class="inline">
															<input type="checkbox" class="ace" />
															<span class="lbl"> Recordarme</span>
														</label>

											<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
												<i class="ace-icon fa fa-key"></i>
												<span class="bigger-110">Ingresar</span>
											</button>


													</div>

													<div class="space-4"></div>
												</fieldset>
											</form>

											<div class="social-or-login center">
												<span class="bigger-110">O Ingresa con</span>
											</div>

											<div class="space-6"></div>

											<div class="social-login center">
												<a class="btn btn-primary">
													<i class="ace-icon fa fa-facebook"></i>
												</a>

												<a class="btn btn-info">
													<i class="ace-icon fa fa-twitter"></i>
												</a>

												<a class="btn btn-danger">
													<i class="ace-icon fa fa-google-plus"></i>
												</a>
											</div>
										</div><!-- /.widget-main -->

										<div class="toolbar clearfix">
											<div>
												<a href="#" data-target="#forgot-box" class="forgot-password-link">
													<i class="ace-icon fa fa-arrow-left"></i>
													Olvide mi contraseña
												</a>
											</div>

											<div>
												<a href="#" data-target="#signup-box" class="user-signup-link">
													Nuevo Registro
													<i class="ace-icon fa fa-arrow-right"></i>
												</a>
											</div>
										</div>
									</div><!-- /.widget-body -->
								</div><!-- /.login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header red lighter bigger">
												<i class="ace-icon fa fa-key"></i>
												Recuperar Contraseña
											</h4>

											<div class="space-6"></div>
											<p>
												Ungresa tu correo electronico para recibir las instrucciones
											</p>

						<form>
							<fieldset>
								<label class="block clearfix">
									<span class="block input-icon input-icon-right">
									<input type="email" class="form-control" placeholder="Email" />
									<i class="ace-icon fa fa-envelope"></i>
									</span>
								</label>
							<div class="clearfix">
								<button type="button" class="width-35 pull-right btn btn-sm btn-danger">
								<i class="ace-icon fa fa-lightbulb-o"></i>
								<span class="bigger-110">Enviar</span>
								</button>
							</div>
							</fieldset>
						</form>
				</div><!-- /.widget-main -->

	<div class="toolbar center">
		<a href="#" data-target="#login-box" class="back-to-login-link">
			Regresar al Login
			<i class="ace-icon fa fa-arrow-right"></i>
			</a>
			</div>
			</div><!-- /.widget-body -->
			</div><!-- /.forgot-box -->

	<div id="signup-box" class="signup-box widget-box no-border">
             	<div class="widget-body">
			<div class="widget-main">
				<h4 class="header green lighter bigger">
					<i class="ace-icon fa fa-users blue"></i>
						Registro de Nuevos Usuarios
				</h4>
	<div class="space-6"></div>
		<p>Ingresa los datos solicitados acontinuacion: </p>
		<form action="<?php $_SERVER["PHP_SELF"]; ?>" method="POST" >
			<fieldset>
			            <label class="block clearfix">
					<span class="block input-icon input-icon-right">
						<input type="text" class="form-control"  name="nombre" placeholder="Nombre Completo"  required />
							<i class="ace-icon fa fa-envelope"></i>
					</span>
				</label>
				<label class="block clearfix">
					<span class="block input-icon input-icon-right">
                  					<input type="text" class="form-control" name="identidad" placeholder="Identidad"   required/>
							<i class="ace-icon fa fa-envelope"></i>
					</span>
				</label>
	                          	<label class="block clearfix">
					<span class="block input-icon input-icon-right">
						<input type="text" class="form-control" name="telefono" placeholder="Telefono"  required />
			                      			<i class="ace-icon fa fa-tel"></i>
					</span>
				</label>
				<label class="block clearfix">
					<span class="block input-icon input-icon-right">
				             	<input type="email" class="form-control" name="correo" placeholder="Email"  required />
					                        <i class="ace-icon fa fa-envelope"></i>
					</span>
				</label>
					<label class="block clearfix">
						<span class="block input-icon input-icon-right">
			                     		<input type="text" class="form-control" name="user" placeholder="Usuario"  required />
                                       				<i class="ace-icon fa fa-user"></i>
  						</span>
				</label>
				<label class="block clearfix">
                     				<span class="block input-icon input-icon-right">
		                      			<input type="password" class="form-control" name="pass" placeholder="Password"  required />
							<i class="ace-icon fa fa-lock"></i>
					</span>
				</label>

				<label class="block clearfix">
					<span class="block input-icon input-icon-right">
						<input type="password" class="form-control" name="passr" placeholder="Repetir password" />
							<i class="ace-icon fa fa-retweet"></i>
									</span>
				</label>

				<label class="block">
					<input type="checkbox" class="ace" />
						<span class="lbl">
						Acepto los
						<a href="#">Terminos de Uso</a>
						</span>
				</label>
				<div class="space-24"></div>
				<div class="clearfix">
					<button type="reset" class="width-30 pull-left btn btn-sm">
						<i class="ace-icon fa fa-refresh"></i>
							<span class="bigger-110">Reset</span>
					</button>
					 <input type="hidden" name="tipo_user" value="2">
					<button type="submit" name="registrar"   class="width-65 pull-right btn btn-sm btn-success">
						<span class="bigger-110">Registrar</span>
							<i class="ace-icon fa fa-arrow-right icon-on-right"></i>
					</button>
					 </div>
			</fieldset>
		</form>
	</div>

			<div class="toolbar center">
				<a href="#" data-target="#login-box" class="back-to-login-link">
					<i class="ace-icon fa fa-arrow-left"></i>
						Regresar al Login
				</a>
			</div>
		</div><!-- /.widget-body -->
	</div><!-- /.signup-box -->
</div><!-- /.position-relative -->

							<div class="navbar-fixed-top align-right">
								<br />
								&nbsp;
								<a id="btn-login-dark" href="#">Oscuro</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-blur" href="#">Azul</a>
								&nbsp;
								<span class="blue">/</span>
								&nbsp;
								<a id="btn-login-light" href="#">Claro</a>
								&nbsp; &nbsp; &nbsp;
							</div>
						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->
			</div><!-- /.main-content -->
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			 $(document).on('click', '.toolbar a[data-target]', function(e) {
				e.preventDefault();
				var target = $(this).data('target');
				$('.widget-box.visible').removeClass('visible');//hide others
				$(target).addClass('visible');//show target
			 });
			});



			//you don't need this, just used for changing background
			jQuery(function($) {
			 $('#btn-login-dark').on('click', function(e) {
				$('body').attr('class', 'login-layout');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'blue');

				e.preventDefault();
			 });
			 $('#btn-login-light').on('click', function(e) {
				$('body').attr('class', 'login-layout light-login');
				$('#id-text2').attr('class', 'grey');
				$('#id-company-text').attr('class', 'blue');

				e.preventDefault();
			 });
			 $('#btn-login-blur').on('click', function(e) {
				$('body').attr('class', 'login-layout blur-login');
				$('#id-text2').attr('class', 'white');
				$('#id-company-text').attr('class', 'light-blue');

				e.preventDefault();
			 });

			});
		</script>
	</body>
</html>
