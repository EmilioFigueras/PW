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

		//Agregar nueva pregunta 
	?>

	<div align='center'>
  		<form method="post" action="agregar.php?var1=<?php echo base64_encode($username); ?>&var2=<?php echo base64_encode($password); ?>">
       			<button type='submit'>Agregar una nueva pregunta</button>
       	</form>
   	</div>
   	
   	<?php
	//ESTADISTICAS
	//Sistema
	//Sistema Operativo
	$total=0;
	$opcion_so=[
		0 => "WIN",
		1 => "MAC",
		2 => "LINUX",
	];
	$consulta = $conn->query("SELECT * FROM EncuestasRellenas");
	while ($sis = $consulta->fetch_array()){
		for($i=0; $i<3; $i++){
			if($sis['os'] == $opcion_so[$i])
				$array[$i]++;
		}
		$total++;
	}
	$consulta->free_result();
	echo "<h3>Sistema Operativo:</h3>";
	for($i=0; $i<3; $i++){
		echo "<h5>".$opcion_so[$i].":</h5>";
		echo '<div class="barra" style="width:'.(($array[$i]*100)/($total)).'%;">'.round((($array[$i]*100)/($total))).'%</div>';
		$array[$i]='0'; //Lo dejamos vacío para futuros usos del array
	}
	echo "<br><br><br>";


	//Navegador
	$opcion_browser =[
		0 => "IE",
		1 => "OPERA",
		2 => "MOZILLA",
		3 => "NETSCAPE",
		4 => "FIREFOX",
		5 => "SAFARI",
		6 => "CHROME",
	];
	$consulta = $conn->query("SELECT * FROM EncuestasRellenas");
	while ($sis = $consulta->fetch_array()){
		for($i=0; $i<7; $i++){
			if($sis['browser'] == $opcion_browser[$i])
				$array[$i]++;
		}
	}
	$consulta->free_result();
	echo "<h3>Navegador usado:</h3>";
	for($i=0; $i<7; $i++){
		echo "<h5>".$opcion_browser[$i].":</h5>";
		echo '<div class="barra" style="width:'.(($array[$i]*100)/($total)).'%;">'.round((($array[$i]*100)/($total))).'%</div>';
		$array[$i]='0'; //Lo dejamos vacío para futuros usos del array
	}
	echo "<br><br><br>";

	//Horas
	$consulta = $conn->query("SELECT * FROM EncuestasRellenas");
	while ($sis = $consulta->fetch_array()){
		$array[intval($sis['hora_comienzo'])]++;
	}
	$consulta->free_result();
	echo "<h3>Horario en el que se realiza la encuesta:</h3>";
	for($i=0; $i<24; $i++){
		echo "<h5>".$i.":00 horas:</h5>";
		echo '<div class="barra" style="width:'.(($array[$i]*100)/($total)).'%;">'.round((($array[$i]*100)/($total))).'%</div>';
		$array[$i]='0'; //Lo dejamos vacío para futuros usos del array
	}

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
	echo '<div class="barra" style="width:'.(($alumnos*100)/($alumnos+$pdi+$pas)).'%;">'.round((($alumnos*100)/($alumnos+$pdi+$pas))).'%</div>';
	echo "<h5>PDI: </h5>";
	echo '<div class="barra" style="width:'.(($pdi*100)/($alumnos+$pdi+$pas)).'%;">'.round((($pdi*100)/($alumnos+$pdi+$pas))).'%</div>';
	echo "<h5>PAS: </h5>";
	echo '<div class="barra" style="width:'.(($pas*100)/($alumnos+$pdi+$pas)).'%;">'.round((($pas*100)/($alumnos+$pdi+$pas))).'%</div>';
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
	echo "<br><br><br>";


	//Hombres y Mujeres
	echo "<h3>Sexo:</h3>";
	echo "<h5>Hombres: </h5>";
	echo '<div class="barra" style="width:'.(($hombres*100)/($hombres+$mujeres)).'%;">'.round((($hombres*100)/($hombres+$mujeres))).'%</div>';
	echo "<h5>Mujeres: </h5>";
	echo '<div class="barra" style="width:'.(($mujeres*100)/($hombres+$mujeres)).'%;">'.round((($mujeres*100)/($hombres+$mujeres))).'%</div>';
	echo "<br><br><br>";
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
			if($array[$i]!="" && $array[$i]!=0){
				echo "<h5>".$i.":</h5>";
				echo '<div class="barra" style="width:'.(($array[$i]*100)/($total)).'%;">'.round((($array[$i]*100)/($total))).'%</div>';
				$array[$i]='0'; //Lo dejamos vacío para futuros usos del array
			}
		}
		echo "<br><br><br>";

	}
	$cons_preg->free_result();

	//Preguntas con Facultades
	$opcion_fac =[
		0 => "Facultad de Derecho (Sede Jerez)",
		1 => "Facultad de Derecho (Sede Algeciras)",
		2 => "Facultad de Ciencias Económicas y Empresariales (Sede Jerez)",
		3 => "Facultad de Ciencias Económicas y Empresariales (Sede Algeciras)",
		4 => "Facultad de Ciencias del Trabajo (Sede Cádiz)",
		5 => "Facultad de Ciencias del Trabajo (Sede Algeciras)",
		6 => "Facultad de Ciencias Sociales y de la Comunicación",
		7 => "Escuela Politécnica Superior de Algeciras",
		8 => "Facultad de Enfermería",
		9 => "Facultad de Enfermería y Fisioterapia",
		10 => "Facultad de Ciencias Económicas y Empresariales",
		11 => "Facultad de Filosofía y Letras",
		12 => "Facultad de Medicina",
		13 => "Escuela Profesional de la Medicina de la Educación Física y Deporte",
		14 => "Escuela de Ingeniería Naval y Oceánica",
		15 => "Facultad de Ciencias",
		16 => "Escuela de Ingenierías Marina, Náutica y Radioelectrónica",
		17 => "Facultad de Ciencias de la Educación",
		18 => "Facultad de Ciencias del Mar y Ambientales",
		19 => "Escuela Superior de Ingeniería",
	];
	$cons_preg = $conn->query("SELECT * FROM Preguntas WHERE tipo='Facultad'");
	while($preg = $cons_preg->fetch_array()){
		$total = 0;
		$consulta = $conn->query("SELECT * FROM Respuestas WHERE id_Preguntas=".$preg['id']);
		while($entero = $consulta->fetch_array()){
			$array[$entero['respuesta']]++;
			$total++;
		}
		$consulta->free_result();
		echo "<h3>".$preg['pregunta']."</h3>";
		for($i=0; $i<20; $i++){
			echo "<h5>".$opcion_fac[$i].":</h5>";
			echo '<div class="barra" style="width:'.(($array[$opcion_fac[$i]]*100)/($total)).'%;">'.round((($array[$opcion_fac[$i]]*100)/($total))).'%</div>';
			$array[$opcion_fac[$i]] = '0';
		}
		echo "<br><br><br>";

	}
	$cons_preg->free_result();

	//Preguntas con puntuaciones
	
	$cons_preg = $conn->query("SELECT * FROM Preguntas WHERE tipo='Puntuar'");
	while($preg = $cons_preg->fetch_array()){
		$total = 0;
		$consulta = $conn->query("SELECT * FROM Respuestas WHERE id_Preguntas=".$preg['id']);
		while($entero = $consulta->fetch_array()){
			$array[$entero['respuesta']]++;
			$total++;
		}
		$consulta->free_result();
		echo "<h3>".$preg['pregunta']."</h3>";
			for($i=1; $i<11; $i++){
				echo "<h5>".$i.":</h5>";
				echo '<div class="barra" style="width:'.(($array[$i]*100)/($total)).'%;">'.round((($array[$i]*100)/($total))).'%</div>';
				$array[$i]='0';
		}
		echo "<br><br><br>";
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
		echo "<br><br><br>";
		$consulta->free_result();
	}
	$cons_preg->free_result();

	$conn->close();
	?>
	<div align="center">
		<form action="inicio.html">
       		<button type="submit">Volver a la página inicial</button>
    	</form>
    </div>

  </body>
</html>