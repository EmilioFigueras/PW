<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="TEXT/html; charset=utf-8" />
<title>Creación de la base de datos</title>
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
$conn->set_charset("utf8");
$conn->close();


//Crear conexion
$conn = new mysqli($servername, $username, $password, $dbname);
//Comprobar conexion
if ($conn->connect_error){
    die("Conexion fallida: " .  $conn->connect_error . "<br>");
}

$conn->set_charset("utf8");
//CRAMOS LAS TABLAS

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
hora_comienzo TIME NOT NULL,
tiempo TIME NOT NULL,
ip tinyTEXT,
browser TEXT,
version TEXT,
os TEXT,
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



//RELLENAMOS LAS TABLAS
//Estudios
$datos = "INSERT INTO Estudios (nombre)
VALUES ('Biblioteca')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Estudios. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Encuestas rellenas


//Dimensiones
//Dimensiones -> Datos personales
$datos = "INSERT INTO Dimensiones (id_Estudios, nombre)
VALUES ('1', 'Datos personales:')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Dimensiones. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Dimensiones -> Personal de la biblioteca
$datos = "INSERT INTO Dimensiones (id_Estudios, nombre)
VALUES ('1', 'Valor afectivo del servicio:')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Dimensiones. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}


//Dimensiones -> Mobiliarios y salas
$datos = "INSERT INTO Dimensiones (id_Estudios, nombre)
VALUES ('1', 'La biblioteca como espacio:')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Dimensiones. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Dimensiones -> Cantidad y calidad de informacion
$datos = "INSERT INTO Dimensiones (id_Estudios, nombre)
VALUES ('1', 'Control de la información:')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Dimensiones. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Dimensiones -> Sugerencias
$datos = "INSERT INTO Dimensiones (id_Estudios, nombre)
VALUES ('1', 'Sugerencias para mejorar: ')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Dimensiones. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}



//PREGUNTAS
//Pregunta 1 respecto a Usuarios
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('1', 'Tipo de usuario: ', 'user', 'PDI, PAS o Alumno', 'Usuario')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 2 respecto a Usuarios
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('1', 'Sexo: ', 'sexo', 'Hombre o mujer', 'Sexo')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 3 respecto a Usuarios
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('1', 'Edad: ', 'campo_int', 'Marcar edad', 'Edad')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 4 respecto a Usuarios
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('1', 'Facultad de procedencia: ', 'Facultad', 'Seleccionar la facultad de procedencia', 'Facultad')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 5 respecto a Usuarios
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('1', 'Biblioteca: ', 'Facultad', 'Selecciona la biblioteca a evaluar', 'Biblioteca')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 1 respecto a Personal
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('2', 'Tiempos de espera para ser atendido: ', 'Puntuar', 'Evalue el tiempo de espera en ser atentido.', 'Espera')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 2 respecto a Personal
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('2', 'Trato del personal: ', 'Puntuar', 'Evalue el trato del personal.', 'Trato')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 3 respecto a Personal
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('2', 'Número adecuado de trabajadores: ', 'Puntuar', 'Evalue si el número de trabajadores actual es el adecuado', 'Trabajadores')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 4 respecto a Personal
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('2', 'Resolución de dudas: ', 'Puntuar', 'Evalue las respuestas del personal a las dudas surgidas.', 'Dudas')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}



//Pregunta 1 respecto a Mobiliario
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('3', 'Limpieza: ', 'Puntuar', 'Evalue la limpieza de las bibliotecas.', 'Limpieza')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 2 respecto a Mobiliario
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('3', 'Estado: ', 'Puntuar', 'Evalue el estado del mobiliario.', 'Estado_Mob')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 3 respecto a Mobiliario
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('3', 'Confort de las salas de trabajo: ', 'Puntuar', 'Evalue la confortabilidad de las salas de trabajo.', 'Confort')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 4 respecto a Mobiliario
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('3', 'Número adecuado de las salas: ', 'Puntuar', 'Evalue si el número actual de salas es el adecuado.', 'Salas')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 5 respecto a Mobiliario
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('3', 'Orden: ', 'Puntuar', 'Evalue el orden estructural del mobiliario.', 'Orden')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 1 respecto a Informacion
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('4', 'Cantidad de información disponible: ', 'Puntuar', 'Evalue si la cantidad de información disponible es la adecuada.', 'Cantidad')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 2 respecto a Informacion
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('4', 'Calidad de la información: ', 'Puntuar', 'Evalue si la calidad de información disponible es la adecuada.', 'Calidad')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 3 respecto a Informacion
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('4', 'Estado de los materiales: ', 'Puntuar', 'Evalue si los materiales de información estan en buen estado.', 'Estado_Inf')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 4 respecto a Informacion
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('4', 'Tiempos de renovación: ', 'Puntuar', 'Evalue si los tiempos de renovación son adecuados.', 'Renovacion')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 5 respecto a Informacion
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('4', 'Utilidad de la biblioteca online: ', 'Puntuar', 'Evalue la utilidad de la biblioteca online.', 'Online')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}

//Pregunta 1 respecto a Sugerencias
$datos = "INSERT INTO Preguntas (id_Dimensiones, pregunta, tipo, descripcion, abbr)
VALUES ('5', 'Agregue sus quejas o sugerencias para la mejora de la Biblioteca: ', 'Sugerencia', 'Aquí puede escribir sus quejas o sugerencias con el propósito de mejorar.', 'Sugerencia')
";

if ($conn->query($datos) === TRUE) {
    echo "Nueva fila creada correctamente en Preguntas. <br>";
} else {
    echo "Error: " . $datos . "<br>" . $conn->error;
}






$conn->close();
?>


</body>
</html> 
