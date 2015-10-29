<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="TEXT/html; charset=utf-8" />
<title>Trabajando con MySQL</title>
</head>

<body>


<?php
/*Conectarme a la base de datos y crear tablas */
$servername = "localhost";
$username = "root";
$password = "toor";
$dbname = "SWECA";

//Crear conexion
$conn = new mysqli($servername, $username, $password);
//Comprobar conexion
if ($conn->connect_error) {
    die("Fallo de conexión: " . $conn->connect_error);
}

//Creamos la base de datos
$sql = "CREATE DATABASE SWECA";
if ($conn->query($sql) === TRUE) {
    echo "Base de datos creada correctamente.<br>";
} else {
    echo "Error al crear la base de datos: " . $conn->error . "<br>";
}

$conn->close();


//Crear conexion
$conn = new mysqli($servername, $username, $password, $dbname);
//Comprobar conexion
if ($conn->connect_error){
    die("Conexion fallida: " . mysqli_connect_error() . "<br>");
}

//Creamos las tablas

//Estudios
$sql = "CREATE TABLE IF NOT EXISTS Estudios (
id INT UNSIGNED AUTO_INCREMENT NOT NULL,
nombre tinyTEXT NOT NULL,
PRIMARY KEY (id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabla Estudios creada correctamente. <br>";
} else {
    echo "Error al crear tabla: " . $conn->error. "<br>";
}


//Encuestas rellenas
$sql = "CREATE TABLE IF NOT EXISTS EncuestasRellenas (
id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
id_Estudios INT UNSIGNED NOT NULL,
hora_comienzo INT NOT NULL,
hora_fin INT NOT NULL,
ip tinyTEXT,
direccion TEXT,
referer TEXT,
userAgent TEXT,
FOREIGN KEY (id_Estudios) REFERENCES Estudios(id)
)";

if ($conn->query($sql) === TRUE){
    echo "Tabla EncuestasRellenas creada correctamente. <br>";
} else {
    echo "Error al crear tabla: " .$conn->error. "<br>";
}

//Dimensiones
$sql = "CREATE TABLE IF NOT EXISTS Dimensiones (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_Estudios INT UNSIGNED NOT NULL,
nombre tinyTEXT NOT NULL,
FOREIGN KEY (id_Estudios) REFERENCES Estudios(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabla Dimensiones creada correctamente. <br>";
} else {
    echo "Error al crear tabla: " . $conn->error. "<br>";
}

//Preguntas

$sql = "CREATE TABLE IF NOT EXISTS Preguntas (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_Dimensiones INT NOT NULL,
pregunta TEXT NOT NULL,
tipo tinyTEXT NOT NULL,
descripcion TEXT,
abbr tinyTEXT NOT NULL,
FOREIGN KEY (id_Dimensiones) REFERENCES Dimensiones(id)
)";

if ($conn->query($sql) === TRUE){
    echo "Tabla Preguntas creada correctamente. <br>";
} else {
    echo "Error al crear tabla: " . $conn->error. "<br>";
}

//Respuestas
$sql = "CREATE TABLE IF NOT EXISTS Respuestas (
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
id_EncuestasRellenas INT NOT NULL,
id_Preguntas INT NOT NULL,
respuesta TEXT NOT NULL,
FOREIGN KEY (id_Preguntas) REFERENCES Preguntas(id),
FOREIGN KEY (id_EncuestasRellenas) REFERENCES EncuestasRellenas(id)
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabla Respuestas creada correctamente. <br>";
} else {
    echo "Error al crear tabla: " . $conn->error. "<br>";
}


//Rellenar tablas
//Estudios
$datos = "INSERT INTO Estudios (nombre)
VALUES ('Biblioteca')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Encuestas rellenas


//Dimensiones


//Preguntas


//Respuestas





$conn->close();




/*

$query="CREATE TABLE Estudios(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre tinyTEXT NOT NULL
	)";
mysql_query($query);



$query="CREATE TABLE EncuestasRellenas(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_Estudios INT NOT NULL,
	hora_comienzo INT NOT NULL,
	hora_fin INT NOT NULL,
	ip TINYTEXT,
	direccion TEXT,
	referer TEXT,
	userAgent TEXT,
	FOREIGN KEY (id_Estudios) REFERENCES Estudios(id)
    )";
mysql_query($query);



$query="CREATE TABLE Dimensiones(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_Estudios INT NOT NULL,
	nombre tinyTEXT NOT NULL,
	FOREIGN KEY (id_Estudios) REFERENCES Estudios(id)
     )";
mysql_query($query);



$query="CREATE TABLE Preguntas(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_Dimensiones INT NOT NULL,
	pregunta TEXT NOT NULL,
	tipo tinyTEXT NOT NULL,
	descripcion TEXT,
	abbr tinyTEXT NOT NULL,
	FOREIGN KEY (id_Dimensiones) REFERENCES Dimensiones(id)
     )";
mysql_query($query);



$query="CREATE TABLE Respuestas(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_EncuestasRellenas INT NOT NULL,
	id_Preguntas INT NOT NULL,
	respuesta TEXT NOT NULL,
	FOREIGN KEY (id_Preguntas) REFERENCES Preguntas(id),
	FOREIGN KEY (id_EncuestasRellenas) REFERENCES EncuestasRellenas(id)
     )";
mysql_query($query);


mysql_close();
*/

?>


</body>
</html> 
