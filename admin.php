<html>
  <head>
    <title>Panel de administración</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="Barra.css">
  </head>
  <body>
  	<div align="center">
  		<form action="agregar.php">
       			<button type="submit">Agregar una nueva pregunta</button>
       	</form>
    </div>
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
	//Pregunta de usuario
	$consulta = $conn->query("SELECT * FROM Respuestas WHERE id_Preguntas='1'");
	$alumnos = 0;
	$pdi = 0;
	$pas = 0;
	while($alum = $consulta->fetch_array()){
		if($alum['respuesta'] == "Alumno")
			$alumnos++;
		elseif($alum['respuesta'] == "PDI")
			$pdi++;
		else 
			$pas++;
	}
	//Tipo de usuario
	echo "<h3>Tipo de usuario:</h3>";
	echo "<h5>Alumnos: </h5>";
	echo '<div class="barra" style="width:'.(($alumnos*100)/($alumnos+$pdi+$pas)).'%;">'.round((($alumnos*100)/($alumnos+$pdi+$pas))).'%</div></li>';
	echo "<h5>PDI: </h5>";
	echo '<div class="barra" style="width:'.(($pdi*100)/($alumnos+$pdi+$pas)).'%;">'.round((($pdi*100)/($alumnos+$pdi+$pas))).'%</div></li>';
	echo "<h5>PAS: </h5>";
	echo '<div class="barra" style="width:'.(($pas*100)/($alumnos+$pdi+$pas)).'%;">'.round((($pas*100)/($alumnos+$pdi+$pas))).'%</div></li>';
	echo "<br><br><br>";



	$consulta->free_result();
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
	//Hombres y Mujeres
	echo "<h3>Sexo:</h3>";
	echo "<h5>Hombres: </h5>";
	echo '<div class="barra" style="width:'.(($hombres*100)/($hombres+$mujeres)).'%;">'.round((($hombres*100)/($hombres+$mujeres))).'%</div></li>';
	echo "<h5>Mujeres: </h5>";
	echo '<div class="barra" style="width:'.(($mujeres*100)/($hombres+$mujeres)).'%;">'.round((($mujeres*100)/($hombres+$mujeres))).'%</div></li>';
	$consulta->free_result();

	//Preguntas con campo de enteros
	$total = 0;
	$cons_preg = $conn->query("SELECT * FROM Preguntas WHERE tipo='campo_int'");
	while($preg = $cons_preg->fetch_array()){
		$consulta = $conn->query("SELECT * FROM Respuestas WHERE id_Preguntas=".$preg['id']);
		while($entero = $consulta->fetch_array()){
			$array[$entero['respuesta']]++;
			$total++;
		}
		$consulta->free_result();
		echo "<h3>".$preg['pregunta']."</h3>";
		for($i=1; $i<100; $i++){
			if($array[$i]!=""){
				echo "<h5>".$i.":</h5>";
				echo '<div class="barra" style="width:'.(($array[$i]*100)/($total)).'%;">'.round((($array[$i]*100)/($total))).'%</div></li>';
			}
		}

	}
	$cons_preg->free_result();

	//Preguntas con Facultades
	/* Pendiente de revision $total = 0;
	$cons_preg = $conn->query("SELECT * FROM Preguntas WHERE tipo='Facultad'");
	while($preg = $cons_preg->fetch_array()){
		$consulta = $conn->query("SELECT * FROM Respuestas WHERE id_Preguntas=".$preg['id']);
		while($entero = $consulta->fetch_array()){
			$array[$entero['respuesta']]++;
			$total++;
		}
		$consulta->free_result();
		echo "<h3>".$preg['pregunta']."</h3>";
		for($i=1; $i<100; $i++){
			if($array[$i]!=""){
				echo "<h5>".$p.":</h5>";
				echo '<div class="barra" style="width:'.(($array[$i]*100)/($total)).'%;">'.round((($array[$i]*100)/($total))).'%</div></li>';
			}
		}

	}
	$cons_preg->free_result();*/

	//Preguntas con puntuaciones
	$total = 0;
	$cons_preg = $conn->query("SELECT * FROM Preguntas WHERE tipo='Puntuar'");
	while($preg = $cons_preg->fetch_array()){
		$consulta = $conn->query("SELECT * FROM Respuestas WHERE id_Preguntas=".$preg['id']);
		while($entero = $consulta->fetch_array()){
			$array[$entero['respuesta']]++;
			$total++;
		}
		$consulta->free_result();
		echo "<h3>".$preg['pregunta']."</h3>";
		for($i=1; $i<11; $i++){
				echo "<h5>".$i.":</h5>";
				echo '<div class="barra" style="width:'.(($array[$i]*100)/($total)).'%;">'.round((($array[$i]*100)/($total))).'%</div></li>';
		}

	}
	$cons_preg->free_result();

	//Sugerencias
	$cons_preg = $conn->query("SELECT * FROM Preguntas WHERE tipo='Sugerencia'");
	$i=1;
	while($preg = $cons_preg->fetch_array()){
		echo "<h3>Sugerencias: </h3>";
		$consulta = $conn->query("SELECT * FROM Respuestas WHERE id_Preguntas=".$preg['id']);
		while($entero = $consulta->fetch_array()){
			if($entero['respuesta']!=""){
				echo "<h5>".$i.".- ".$entero['respuesta']."</h5>";
				$i++;
			}
			
		}
		$consulta->free_result();
	}
	$cons_preg->free_result();

	$conn->close();
	?>

  </body>
</html>