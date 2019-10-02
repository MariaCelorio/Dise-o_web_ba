<?php

	// PASO 1: RECUPERAR LOS DATOS INTRODUCIDOS EN EL FORMULARIO
	session_start(); // session_start — Iniciar una nueva sesión o reanudar la existente http://php.net/manual/es/function.session-start.php
	
	$_POST = $_SESSION; // Recuperamos los datos que había introducido el usuario en el formulario, y que habíamos guardado en la sesión, desde el archivo index.php


	// PASO 2: DATOS DE CONEXIÓN. Incrustamos el archivo que contiene los datos de conexión.
	include_once ("conexion_final.php");
	
	/* PASO 3: COMPROBAR LA EXISTENCIA DE CAMPOS con isset() Y QUE NO ESTÉN VACÍOS con !empty()
	A continuacíon, vamos a comprobar mediante la función isset, que todos los campos del formulario existan, y además con la función !empty vamos a comprobar que no estén vacíos. Al utilizar el operador &&, significa que todas esas condiciones deben cumplirse. Si falla solo una, dará error. */
	 if (
		   ( isset ($_POST['usuarioform']) && !empty($_POST['usuarioform']) ) 
			&&  
		   ( isset ($_POST['passwform']) && !empty($_POST['passwform']) ) 
			/* ***** INSTRUCCIONES DE LO QUE DEBÉIS COMPLETAR: debéis hacer lo mismo con el resto de campos */
	) 
	{
		//Si las condiciones del "if" se cumplen, entonces se realiza la conexión mediante la función mysqli_connect
		/* $con = mysqli_connect ($host, $user, $pw) or die ("Problemas al conectar con el Host Server de MySQL"); */
		
		// Seleccionamos el nombre de la Base de datos con la que vamos a conectar.
		/* mysqli_select_db ($con, $db) or die ("Problemas al conectar con la Base de datos"); */
		
		/* PASO 4: SENTENCIAS PREPARADAS **************************************************************** 
			http://php.net/manual/es/mysqli.quickstart.prepared-statements.php
			Escape de valores e inyección SQL
			Las variables vinculadas son enviadas desde la consulta al servidor por separado, por lo que no se puede interferir. El servidor usa estos valores directamente en el momento de la ejecución, después de haber analizado la plantilla de la sentencia. Los parámetros vinculados no necesitan ser escapados porque nunca son sustituidos directamente dentro del string de consulta. Se puede proporcionar una sugerencia al servidor para el tipo de variable vinculada, para crear una conversión apropiada. 
		
			Véase la función mysqli_stmt_bind_param() para más información http://php.net/manual/es/mysqli-stmt.bind-param.php 
			*/
			
		 /* $mysqli = new mysqli($host, $user, $pw, $db); // new mysqli se usa en Programación Orientada a Objetos (POO) y mysqli_connect se utiliza en Programación Orientada a Procedimientos 
		 */
		
		// Realizar la conexión
		$mysqli = mysqli_connect ($host, $user, $pw, $db);
		if ($mysqli->connect_errno) {
			echo "Falló la conexión a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
		} 
		
		// Variables a insertar en la Base de datos
		$nombrevalidado = utf8_decode($_POST['nombreform']);
		$nombreseguro = mysqli_real_escape_string($mysqli, $nombrevalidado);
		$apellidosvalidado = utf8_decode($_POST['apellidosform']);
		$ciudadvalidado = utf8_decode($_POST['ciudadform']);
		/* ***** INSTRUCCIONES DE LO QUE DEBÉIS COMPLETAR: tenéis que hacer lo mismo con el resto de campos alfanuméricos (con los que son sólo numéricos no es necesario). Es decir, crear las variables
		$usuariovalidado y $usuarioseguro
		$apellidosvalidado y $apellidosseguro
		$ciudadvalidado y $ciudadsseguro
		etc., etc.
		*/
		
		/* Sentencia preparada, etapa 1: preparación */
		if (!($sentencia = $mysqli->prepare("INSERT INTO tb_usuarios (usuario, clave, nombre, apellidos, edad, email, ciudad, fecha_nacimiento) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"))) {
			 echo "Falló la preparación: (" . $mysqli->errno . ") " . $mysqli->error;
		}
		
		/* Sentencia preparada, etapa 2: vinculación */	
		if (!$sentencia->bind_param('ssssisss', $usuarioseguro, $_POST['passwform'], $nombreseguro, $apellidosvalidado, $_POST['edadform'], $_POST['emailform'], $ciudadvalidado, $_POST['nacimientoform'])
		) {
			echo "Falló la vinculación de parámetros: (" . $sentencia->errno . ") " . $sentencia->error;
		}
		/* Sentencia preparada, etapa 3: ejecución */
		if (!$sentencia->execute()) {
			echo "Falló la ejecución: (" . $sentencia->errno . ") " . $sentencia->error;
		}

		/* Se recomienda el cierre explícito de la sentencia preparada */
		$sentencia->close();
		
		/* Cerrar la conexión */
		$mysqli->close();

		echo "<p class='mensaje-post-insertar'>Los datos del nuevo usuario se han insertado con éxito. </p><p>Te damos la bienvenida ".utf8_encode($_POST['nombreform'])."</p>
		<p>Ahora puedes consultar datos, o hacer Login</p>";
	}
	else {
		echo "<p id='mensaje-post-insertar'>Problemas al insertar los datos</p>";
	}

?>


<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scaale=1, maximum-scale=1, minimum-scale=1">
        <title>Formulario de Login de usuario</title>
        <link rel="stylesheet" media="screen" href="css/form-styles.css" >
    </head>
    
    <body>
        <!-- FORMULARIO DE LOGIN -->
        <div id="contenedor-login">
            <!-- <h2>Login de usuario registrado</h2> -->
            <form action="login-validar-mysqli.php" method="post">
              <fieldset>
                <legend>Login</legend>
                 <div>
                 	<input type="text" name="usuarioform" placeholder="Usuario" maxlength="20" required tabindex="1" />
                 </div>
                 <div>
                    <input type="password" name="passwform" placeholder="&#128272; Contraseña" required />
                 </div>
               </fieldset>
               	<div class="contenedor-botones">
               		<input type="submit" value="Entrar a mi cuenta" />
                </div>
            </form>
        </div>
        
        <!-- FORMULARIO PARA CONSULTAR DATOS en la base de datos MySQL -->
        <div id="contenedor-consulta">
        	<h2> Consulta de datos</h2>
            <form action="consultar_final_mysqli.php" method="post" name="form">
              <div>
              	<label>Edad: </label>
                <input type="number" name="edadconsulta" placeholder="Escribir la edad con números"></input>
              </div>
              <div>
              	<label>Ciudad: </label>
                <input type="text" name="ciudadconsulta"></input>
                </div>
                <div>
                	<label>Nombre: </label>
                    <input type="text" name="nombreconsulta"></input>
                </div>
                <div class="contenedor-botones">
                	<input type="reset" value="Limpiar los datos"></input>
                	<input type="submit" value="Buscar"></input>
                </div>
            </form>
        </div>
        
        
    </body>
</html>