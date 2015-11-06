<html>
  <head>
    <title>Panel de administración</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="Barra.css">
  </head>
  <body>
  	<?php
  	//Conexion con la base
	$servername = "localhost";
	$username = $_POST["usuario"];
	$password = $_POST["pass"];
	$dbname = "SWECA";

	//Crear conexion
	$conn = new mysqli($servername, $username, $password, $dbname);
	//Comprobar conexion
	if ($conn->connect_error){
    die("Conexion fallida: " .  $conn->connect_error . "<br>");
	}
	$conn->set_charset("utf8");



	//ESTADISTICAS
	//Pregunta de sexo
	$consulta = $conn->query("SELECT * FROM Respuestas WHERE id_Preguntas='2'");
	$hombres = 0;
	$mujeres = 0;
	while($sexo = $consulta->fetch_array()){
		if($sexo['respuesta'] == "Hombre")
			$hombres++;
		else
			$mujeres++;
	}
	
	echo "<h3>Hombres: </h3>";
	echo '<div class="barra" style="width:'.(($hombres*100)/($hombres+$mujeres)).'%;">'.round((($hombres*100)/($hombres+$mujeres))).'%</div></li>';
	echo "<br><br>";
	echo "<h3>Mujeres: </h3>";
	echo '<div class="barra" style="width:'.(($mujeres*100)/($hombres+$mujeres)).'%;">'.round((($mujeres*100)/($hombres+$mujeres))).'%</div></li>';

	$consulta->free_result();
	$conn->close();
	?>

  </body>
</html>