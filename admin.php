<html>
  <head>
    <title>Panel de administración</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
	echo $hombres;
	echo "<br><br>";
	echo $mujeres;


	$consulta->free_result();
	$conn->close();
	?>

  </body>
</html>