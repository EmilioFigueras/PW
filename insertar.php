<HTML>
	<HEAD>
		<TITLE>Insertar.php</TITLE>
	</HEAD>
	<BODY>
	<?php
//Conexion con la base
$servername = "localhost";
$username = "root";
$password = "toor";
$dbname = "SWECA";

//Crear conexion
$conn = new mysqli($servername, $username, $password, $dbname);
//Comprobar conexion
if ($conn->connect_error){
    die("Conexion fallida: " .  $conn->connect_error . "<br>");
}
$conn->set_charset("utf8");


$info=detect();
$ip = getRealIP();
$browser = $info['browser'];
$version = $info['version'];
$os = $info['os'];
$hora_comienzo = base64_decode($_GET["var"]); //Recibimos y desencriptamos la hora de inicio
$hora_fin = date("H:i:s");
$tiempo = resta($hora_comienzo, $hora_fin);

if(strtotime($tiempo)<strtotime("00:00:10")){
	echo "Tiempo en hacer la encuesta demasiado corto.";
}else{

//Registrmos al usuario
$datos = "INSERT INTO EncuestasRellenas (id_Estudios, hora_comienzo, tiempo, ip, browser, version, os) 
VALUES ('1', '$hora_comienzo', '$tiempo', '$ip', '$browser', '$version', '$os')";
if ($conn->query($datos) === TRUE) {
    echo "Conexión establecida correctamente con el usuario. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}



$consulta_Encuesta = $conn->query("SELECT id FROM EncuestasRellenas");
$num_filas = $consulta_Encuesta->num_rows;
$consulta_Encuesta->close();



//Ejecucion de la sentencia SQL
//Recibimos los datos
$Usuario = $_POST['Usuario'];
$Sexo = $_POST['Sexo'];
$Edad = $_POST['Edad'];
$Facultad = $_POST['Facultad'];
$Biblioteca = $_POST['Biblioteca'];
$Espera = $_POST['Espera'];
$Trato = $_POST['Trato'];
$Trabajadores = $_POST['Trabajadores'];
$Dudas = $_POST['Dudas'];
$Limpieza = $_POST['Limpieza'];
$Estado_Mob = $_POST['Estado_Mob'];
$Confort = $_POST['Confort'];
$Salas = $_POST['Salas'];
$Orden = $_POST['Orden'];
$Cantidad = $_POST['Cantidad'];
$Calidad = $_POST['Calidad'];
$Estado_Inf = $_POST['Estado_Inf'];
$Renovacion = $_POST['Renovacion'];
$Online = $_POST['Online'];
$Sugerencia = $_POST['Sugerencia'];

//Pregunta 1
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '1', '$Usuario')");

//Pregunta 2
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '2', '$Sexo')");

//Pregunta 3
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '3', '$Edad')");

//Pregunta 4
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '4', '$Facultad')");

//Pregunta 5
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '5', '$Biblioteca')");

//Pregunta 6
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '1', '$Espera')");

//Pregunta 7
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '2', '$Trato')");

//Pregunta 8
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '3', '$Trabajadores')");

//Pregunta 9
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '4', '$Dudas')");

//Pregunta 10
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '1', '$Limpieza')");

//Pregunta 11
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '2', '$Estado_Mob')");

//Pregunta 12
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '3', '$Confort')");

//Pregunta 13
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '4', '$Salas')");

//Pregunta 14
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '5', '$Orden')");

//Pregunta 15
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '1', '$Cantidad')");

//Pregunta 16
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '2', '$Calidad')");

//Pregunta 17
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '3', '$Estado_Inf')");

//Pregunta 18
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '4', '$Renovacion')");

//Pregunta 19
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '5', '$Online')");

//Pregunta 20
$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', '1', '$Sugerencia')");


//mysql_query("insert into Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) values (1, 1, '$tipo','$sexo')");
    




}
$conn->close();

//FUNCIONES
//Funcion para obtener ip (no funciona, no devuelve nada)
function getRealIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
           
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
       
        return $_SERVER['REMOTE_ADDR'];
    }

/**
 * Funcion que devuelve un array con los valores:
 *	os => sistema operativo
 *	browser => navegador 
 *	version => version del navegador 
 */
function detect()
{
	$browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
	$os=array("WIN","MAC","LINUX");
	# definimos unos valores por defecto para el navegador y el sistema operativo
	$info['browser'] = "OTHER";
	$info['os'] = "OTHER";

	# buscamos el navegador con su sistema operativo
	foreach($browser as $parent)
	{
		$s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
		$f = $s + strlen($parent);
		$version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
		$version = preg_replace('/[^0-9,.]/','',$version);
		if ($s)
		{
			$info['browser'] = $parent;
			$info['os'] = $version;
		}
	}
	# obtenemos el sistema operativo
	foreach($os as $val)
	{
		if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
			$info['version'] = $val;
	}
	# devolvemos el array de valores
	return $info;

}


/*Funcion que devuelve la resta de dos fechas*/
function resta($inicio, $fin)
  {
  $dif=date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio) );
  return $dif;
  }

?>
<h1><div align="center">Registro Insertado</div></h1>
<div align="center"><a href="lectura.php">Visualizar el contenido de la base</a></div>
</BODY>
</HTML>  
