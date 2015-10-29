<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Trabajando con MySQL</title>
</head>

<body>


<?
$user="root";
$password="";
$database="ej_encuestas";


mysql_connect(localhost,$user,$password);

@mysql_select_db($database) or die( "Unable to select database");



$query="CREATE TABLE Estudios(
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre tinytext NOT NULL
	)";
mysql_query($query);



$query="CREATE TABLE EncuestasRellenas(
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_Estudios int NOT NULL,
	hora_comienzo int NOT NULL,
	hora_fin int NOT NULL,
	ip TINYTEXT,
	direccion TEXT,
	referer TEXT,
	userAgent TEXT,
	FOREIGN KEY (id_Estudios) REFERENCES Estudios(id)
    )";
mysql_query($query);



$query="CREATE TABLE Dimensiones(
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_Estudios int NOT NULL,
	nombre tinytext NOT NULL,
	FOREIGN KEY (id_Estudios) REFERENCES Estudios(id)
     )";
mysql_query($query);



$query="CREATE TABLE Preguntas(
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_Dimensiones int NOT NULL,
	pregunta text NOT NULL,
	tipo tinytext NOT NULL,
	descripcion text,
	abbr tinytext NOT NULL,
	FOREIGN KEY (id_Dimensiones) REFERENCES Dimensiones(id)
     )";
mysql_query($query);



$query="CREATE TABLE Respuestas(
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	id_EncuestasRellenas int NOT NULL,
	id_Preguntas int NOT NULL,
	respuesta text NOT NULL,
	FOREIGN KEY (id_Preguntas) REFERENCES Preguntas(id),
	FOREIGN KEY (id_EncuestasRellenas) REFERENCES EncuestasRellenas(id)
     )";
mysql_query($query);

mysql_close();
?>


</body>
</html>
