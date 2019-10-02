<?php
    ob_start();

    header('content-Type: text/html; charset=utf-8');

    include_once 'funciones/validaciones/php';
?>





<!doctype html>
<html lang="es" dir"ltr">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Formulario de registro y login</title>
	</head>

	<body>
		<div id="contenedor-login">
			<form action="login-validar-mysqli.php" method="post">
				<fieldset>
					<legend>Login</legend>
					<div>
						<input type="text" name="usuarioform"
						placeholder="&#x263a;Usuario con letras y números"
					 	minilength="4" maxlength="20" required />
					</div>
					<div>
						<input type="password" name="passwform" placeholder="&#128272; Minimo 5 caracteres" minlength="5" maxlength="100" required />
					</div>
					
				</fieldset>
				<div class="form-consultar.php">
					<input type="submit" value="Entrar a mi cuenta"/>
				</div>
				
			</form>
		</div>
		<!-- FORMULARIO DE REGISTRO DE NUEVO USUARIO PARA INSERTAR DATOS en la base de datos MySQL -->
        <div id="contenedor-insercion">
        	<h2>Registro de nuevo usuario</h2> 
        
			<!-- LISTA DE ERRRORES DESPUÉS DE LA VALIDACIÓN -->
			<?php if ($errores): ?>
				<ul style="color: #f00;">
					<?php foreach ($errores as $error): ?>
						<li> <?php echo $error ?> </li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>


			<!-- Con el action vacío action="" se reenvía el formulario a sí mismo (a la propia página index.php), para ejecutar la validación antes de enviarse al archivo insertar_final_mysql.php que es para insertar los datos en la base de datos MySQL
			
			También se podría poner el nombre del propio archivo action="index.php"

			https://stackoverflow.com/questions/8066797/using-php-self-in-the-action-field-of-a-form
			También se pueden usar en el action $_SERVER['PHP_SELF']
			<form action="<?php //echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

			o bien $_SERVER['REQUEST_URI']
			<form action="<?php //echo htmlentities($_SERVER['REQUEST_URI']); ?>" method="POST"> que devuelve la URL actual
			-->   
        
			<form action="" method="post" name="contact_form" class="contact_form"> 
				  <fieldset>
						  <legend>Información de usuario web</legend>
						  <div>
							<label for="usuarioform">Usuario<strong><abbr title="required">*</abbr></strong>: </label>
							<input type="text" name="usuarioform" maxlength="20" autofocus required title="Es necesario escribir un nombre de usuario y sólo admite letras, números y guión bajo _" value="<?php echo $usuario ?>" tabindex="1" /><span class="form_hint">Formato adecuado: "letras y números"</span>
						  </div>
						  <div>
							<label for="passwform">Contraseña<strong><abbr title="required">*</abbr></strong>: </label>
							<input type="password" name="passwform" placeholder="&#128272; Contraseña de 8 dígitos alfanuméricos" maxlength="100" required title="Es necesario escribir una contraseña" value="<?php echo $clave ?>" tabindex="2" id="myPassw" />
							
							<!-- PARA VER Y OCULTAR LA CONTRASEÑA ESCRITA (se hace por JavaScript) -->
							<input type="checkbox" onclick="ShowHide()">Show Password
							<script>
								function ShowHide() {
									var x = document.getElementById("myPassw");
									if (x.type === "password") {
										x.type = "text";
									} else {
										x.type = "password";
									}
								}
							</script>
						  </div>
					 </fieldset> 
					 
					<fieldset>
						<legend>Información personal</legend>  
							<div>
								<label>Nombre: </label>
								<input type="text" name="nombreform" value="<?php echo $nombre ?>" tabindex="3" />
							</div>

							<div>
								<label>Apellidos: </label>
								<input type="text" name="apellidosform" value="<?php echo $apellidos ?>" tabindex="4" />
							</div>

							<div>
								<label>Edad: </label>
								<input type="number" name="edadform" placeholder="Escribir la edad con números" size="3" value="<?php echo $edad ?>" required />
							  </div>

							<div>
								<label>Email<strong><abbr title="required">*</abbr></strong>: </label>
								<input type="email" name="emailform" placeholder="Escriba su correo electrónico" value="<?php echo $email ?>" required  />
							</div>

							<div>
								<label>Ciudad: </label>
								<input type="text" name="ciudadform" value="<?php echo htmlentities($ciudad) ?>" required />
							</div>

							<div>
								<label>Fecha de nacimiento: </label>
								<input type="date" name="nacimientoform" placeholder="Formato aaaa-mm-dd" value="<?php echo $fechanacimiento ?>" />
							</div>

							<div>
								<label>Género: </label>
								<input type="radio" name="generoform" id="hombre" value="hombre"  />
								<label for="hombre">Hombre</label>
								<input type="radio" name="generoform" id="mujer" value="mujer"  />
								<label for="mujer">Mujer</label>
							</div>

                            <div>
								<label>Soltero: </label>
								<input type="radio" name="solteroform" id="si" value="si"  />
								<label for="si">Si</label>
								<input type="radio" name="solteroform" id="no" value="no"  />
                                <label for="no">No</label>
                                <input type="radio" name="solteroform" id="es complicado" value="es compliacdo"  />
								<label for="es complicado">Es complicado</label>
                            </div>

                            <div>
								select 
                            </div>
                            

					</fieldset>

					<div class="contenedor-botones">
						<input type="reset" value="Limpiar los datos" />
						<input type="submit" value="Crear mi cuenta" class="enviosubmit" />
					</div>

				</form> 
        </div>
	</body>
</html>