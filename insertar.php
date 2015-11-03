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

//Funcion para obtener ip (no funciona, no devuelve nada)
function get_ip() {
		//Just get the headers if we can or else use the SERVER global
		if ( function_exists( 'apache_request_headers' ) ) {
			$headers = apache_request_headers();
		} else {
			$headers = $_SERVER;
		}
		//Get the forwarded IP if it exists
		if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
			$the_ip = $headers['X-Forwarded-For'];
		} elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )
		) {
			$the_ip = $headers['HTTP_X_FORWARDED_FOR'];
		} else {
			
			$the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
		}
		return $the_ip;
	}


$ip = get_ip();
/*
echo $ip;
echo "<br>";
*/





//Registrmos al usuario
$datos = "INSERT INTO EncuestasRellenas (id_Estudios, hora_comienzo, hora_fin, ip, direccion, referer, userAgent) 
VALUES ('1', '00:00', '12:00', '$ip', 'local', 'que', 'emilio')";
if ($conn->query($datos) === TRUE) {
    echo "Conexión establecida correctamente con el usuario. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}


//Ejecucion de la sentencia SQL
//Recibimos los datos
$Usuario = $_POST['Usuario'];
$Sexo = $_POST['Sexo'];
$Edad = $_POST['Edad'];
$Facultad = $_POST['Facultad'];
$Biblioteca = $_POST['Biblioteca'];

//Pregunta 1
$datos = "INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('1', '1', '$Usuario')";
if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Respuestas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 2
$datos = "INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('1', '2', '$Sexo')";
if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Respuestas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 3
$datos = "INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('1', '3', '$Edad')";
if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Respuestas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 4
$datos = "INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('1', '4', '$Facultad')";
if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Respuestas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 5
$datos = "INSERT INTO Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) VALUES ('1', '5', '$Biblioteca')";
if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Respuestas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}


//mysql_query("insert into Respuestas (id_EncuestasRellenas, id_Preguntas, respuesta) values (1, 1, '$tipo','$sexo')");
    





$conn->close();
?>
<h1><div align="center">Registro Insertado</div></h1>
<div align="center"><a href="lectura.php">Visualizar el contenido de la base</a></div>
</BODY>
</HTML>  
