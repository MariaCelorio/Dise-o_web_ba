<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Form consultar</title>
<link rel="stylesheet" media="screen" href="css/form-styles.css" >
</head>

<body>

 
        <!-- FORMULARIO PARA CONSULTAR DATOS en la base de datos MySQL -->
        <div id="contenedor-consulta">
        	<h2> CONSULTA DE DATOS</h2>
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