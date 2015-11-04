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
function getRealIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
           
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
       
        return $_SERVER['REMOTE_ADDR'];
    }


$ip = getRealIP();

echo $ip;
echo "<br>";





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
