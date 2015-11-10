<HTML>
	<HEAD>
		<TITLE>Encuesta completada</TITLE>
	</HEAD>
	<BODY>
	<?php

include 'conexion.php';
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

if(strtotime($tiempo)<strtotime("00:00:18")){
	echo "Tiempo en hacer la encuesta demasiado corto.";
}else{

//Registramos al usuario
$datos = "INSERT INTO EncuestasRellenas (id_Estudios, hora_comienzo, tiempo, ip, browser, version, os) 
VALUES ('1', '$hora_comienzo', '$tiempo', '$ip', '$browser', '$version', '$os')";
if ($conn->query($datos) === TRUE) {} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}



$consulta_Encuesta = $conn->query("SELECT id FROM EncuestasRellenas");
$num_filas = $consulta_Encuesta->num_rows;
$consulta_Encuesta->close();

//Ejecucion de la sentencia SQL
//Recibimos los datos

$cons_preg = $conn->query("SELECT * FROM Preguntas"); //Sacamos las preguntas
while($preg = $cons_preg->fetch_array()){
	$resp = $_POST[$preg['abbr']];
	$conn->query("INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('$num_filas', ".$preg['id'].", '$resp')");
}
$cons_preg->free_result();
$conn->close();

echo "<div align='center'><h1>Gracias por su colaboración.</h1></div>";

}//fin else

//FUNCIONES
//Funcion para obtener ip (el localhost lo devuelve en ipv6, ::1)
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
			$info['version'] = $version;
		}
	}
	# obtenemos el sistema operativo
	foreach($os as $val)
	{
		if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
			$info['os'] = $val;
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
<div align="center">
	<form action="inicio.html">
       	<button type="submit">Volver a la página inicial</button>
    </form>
</div>

</BODY>
</HTML>  
