<html>
  <head>
    <title>Procesamiento</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>
  	<?php

 		//Conexion con la base
		$servername = "localhost";
		$username = "admin";
		$password = "admin";
		$dbname = "SWECA";

		//Crear conexion
		$conn = new mysqli($servername, $username, $password, $dbname);
		//Comprobar conexion
		if ($conn->connect_error){
    		die("Conexion fallida: " .  $conn->connect_error . "<br>");
		}
		$conn->set_charset("utf8");

  		$Pregunta = $_POST['Pregunta'];
  		$Tipo = $_POST['Tipo'];
  		$Descripcion = $_POST['Descripcion'];
  		$Abbr = $_POST['Abbr'];
  		$Dimension = $_POST['Dimension'];

  		//Insertamos la nueva pregunta
  		$conn->query("INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr) 
  			VALUES ('$Dimension', '$Pregunta', '$Tipo', '$Descripcion', '$Abbr')");
  		echo "<h3>Pregunta insertada. </h3>";
  	?>
  	<form action="inicio.html">
       	<button type="submit">Volver a la página inicial</button>
    </form>

  </body>
</html>