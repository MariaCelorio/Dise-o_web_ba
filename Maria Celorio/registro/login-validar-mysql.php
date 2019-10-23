<?php
	/* Conectar a la Base de Datos MySQL creada en el  PhpMyAdmin de mi hosting en https://www.000webhost.com */	

	$miusuario=$_POST['usuarioform'];	
	$miclave=$_POST['passwform'];
	
	/* mysqli_connect("servidorhost DB Host", "miusuario DB user", "micontraseña de la base de datos", "mibasededatos DB Name") */
	$conexion=mysqli_connect ("localhost", "id9586802_maria", "Celorio09", "id9586802_registro") or die ("Problemas al conectar con el Servidor Host de MySQL");
	
	$consulta="SELECT * FROM tb_usuarios WHERE usuario='$miusuario' and clave='$miclave' ";

	$resultado= mysqli_query($conexion, $consulta);
	
	$filas=mysqli_num_rows($resultado);// Si usuario y contraseña no coinciden, me va a devolver cero.
	
	if ($filas>0) { 
		 header("location:form-consultar.php"); // location redirecciona a otra página, en este caso, a la página form_consultar.php
	} else {
	   echo "Error en el login.";
	}

	mysqli_free_result($resultado); // mysqli_free_result() libera los resultados, porque está consumiendo espacio en memoria
	mysqli_close($conexion); // mysqli_close() cierra la conexión, para que no se mantenga en memoria y no consuma recursos
	
?>