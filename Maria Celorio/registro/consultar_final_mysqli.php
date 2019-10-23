<?php
	/* ******** DATOS DE CONEXIÓN CON LA BASE DE DATOS ******** */
	include ("conexion_final.php");


	/* ******** PARA QUE LA CONSULTA FUNCIONE CUANDO SE PONE EL NOMBRE CON TILDE, LA BASE DE DATOS DEBE ESTAR EN CODIFICACIÓN UTF8 ******** */
	$charset = mysqli_character_set_name($con);
	// echo "<p>The current character set before is: ".$charset."</p>"; 
	// Esto devuelve el juego actual de caracteres.
	
	mysqli_set_charset($con,'utf8'); // Aquí cambiamos el juego de caracteres a utf8, por si acaso en la base de datos no estaba bien configurado. Esta función establece el conjunto de caracteres del cliente http://php.net/manual/es/function.mysql-set-charset.php Ajusta UTF-8 como el conjunto de caracteres por defecto para todas las conexiones de MySQL
	
	$charset = mysqli_character_set_name($con); // Devuelve el nombre del conjunto de caracteres http://php.net/manual/es/function.mysql-client-encoding.php
	//echo "<p>The current character set after is: ".$charset."</p>";
	// Otra manera: mysql_query("SET NAMES 'utf8'");


	/* ******** REALIZACIÓN DE LA CONSULTA o QUERY  ******** */
	  if (
		   ( isset($_POST['edadconsulta']) && !empty($_POST['edadconsulta']) )
			
		  /* ***** INSTRUCCIONES DE LO QUE DEBÉIS COMPLETAR: TENÉIS QUE HACER que se pueda buscar por edad O BIEN por ciudad O BIEN por nombre. Es decir, en vez de utilizar el símbolo && que significa AND, ahora debéis usar el símbolo que significa "o" ("o esto", "o lo otro"). Buscad los operadores lógicos y matemáticos que vimos en una tabla en clase. */
	  )
	  {	
			echo "<h2>Resultados de su consulta</h2>";
			$dato1= $_POST['edadconsulta'];
		  	$dato2 = $_POST['nombreconsulta'];
		  	$dato3 = $_POST['ciudadconsulta'];
			// ***** INSTRUCCIONES DE LO QUE DEBÉIS COMPLETAR: TENÉIS QUE HACER LO MISMO CON ciudadconsulta y con nombreconsulta y guardarlos en variables, igual que se ha hecho con $dato1

			 /* $mysqli = new mysqli($host, $user, $pw, $db); // new mysqli se usa en Programación Orientada a Objetos (POO) y mysqli_connect se utiliza en Programación Orientada a Procedimientos 
			 */

			// Realizar la conexión
			$mysqli = new mysqli($host, $user, $pw, $db);
		  
			/* Verificar la conexión */
			if (mysqli_connect_errno()) {
				printf("Falló la conexión failed: %s\n", $mysqli->connect_error);
				exit();
			}		


			/* SENTENCIAS PREPARADAS: Crear y ejecutar una sentencia preparada */
			
		    /* ***** INSTRUCCIONES DE LO QUE DEBÉIS COMPLETAR: dentro de los paréntesis del IF tenéis que poder buscar POR EDAD O POR NOMBRE O POR CIUDAD.Es decir, que si escribís en Edad 22 años y en Ciudad de México, en los resultados os aparezcan todos los usuarios con 22 años, y también todos los que pusieron Ciudad de México (aunque no tengan 22 años).
			WHERE condición OR condición 
			*/
		  
		  	/* Sentencia preparada, etapa 1: preparación */
			$sentencia =  $mysqli->stmt_init();
			if ($sentencia->prepare("SELECT * FROM tb_usuarios WHERE edad=? ")) {

				/* Sentencia preparada, etapa 2: vinculación */
				
				// ***** INSTRUCCIONES DE LO QUE DEBÉIS COMPLETAR: en bind_param debéis añadir en las comillas el tipo de dato de ciudadconsulta y nombreconsulta y luego añadir las otras variables parecidas a $dato1 donde se guardaron esos datos separados por coma
				$sentencia->bind_param("iss", $dato1, $dato2, $dato3);

				/* Sentencia preparada, etapa 3: ejecución */
				$sentencia->execute();

				/* Sentencia preparada, etapa 4: vincular las variables de los resultados */
				// ***** INSTRUCCIONES DE LO QUE DEBÉIS COMPLETAR: añadir $col_nombredevuestrocamporadiobutton y $col_nombredevuestrocamposelect y $col_nombredevuestrocampocheckbox
				$sentencia->bind_result($col_id, $col_usuario, $col_clave, $col_nombre, $col_apellidos, $col_edad, $col_email, $col_ciudad, $col_fechanacimiento);		

				print ("<h2>TABLA DE RESULTADOS DE LA CONSULTA</h2>");
				/* DEVOLVER RESULTADOS EN UNA TABLA */
				// ***** INSTRUCCIONES DE LO QUE DEBÉIS COMPLETAR: añadir el código necesario para que se muestren en la tabla los nuevos campos: de tipo radio button, select y checkbox
				print ("<table>
						  <thead>
							  <tr>
								<th>Usuario</th>
								<th>Nombre</th>
								<th>Apellidos</th>
								<th>Edad</th>
								<th>Email</th>
								<th>Ciudad</th>
								<th>Fecha de nacimiento</th>
								<th>Genero</th>
								<th>Soltero</th>
								<th>Diseño</th>
								
							  </tr>
						  </thead>
						  <tbody>");

					 // Obtener los valores
					// ***** INSTRUCCIONES DE LO QUE DEBÉIS COMPLETAR: añadir el código necesario para incluir $col_nombredevuestrocamporadiobutton y $col_nombredevuestrocamposelect  	  
					while($sentencia->fetch()) { 
						   $bindResults = array($col_id, $col_usuario, $col_clave, $col_nombre, $col_apellidos, $col_edad, $col_email, $col_ciudad, $col_fechanacimiento);

							print("<tr><td>");
							printf("%s", $col_usuario);
							print("</td>");
							print("<td>".$col_nombre."</td>");
							print("<td>");
							printf("%s", $col_apellidos);
							print("</td><td>");
							printf("%s", $col_edad);
							print("</td><td>");
							printf("%s", $col_email);
							print("</td><td>");
							printf("%s", $col_ciudad);
							print("</td><td>");
							printf("%s", $col_fechanacimiento);
							print("</td></tr>");
							printf("%s", $col_genero);
							print("</td><td>");
							printf("%s", $col_soltero);
							print("</td><td>");
							printf("%s", $col_diseño);
							print("</td></tr>");
					  }

				print ("</tbody></table>");

				/* Cerrar la sentencia */
				$sentencia->close();	

				/* Cerrar la conexión */
				$mysqli->close();

			}
	  }
	  else {
		  echo "Problemas al consultar los datos";
	  }

?>