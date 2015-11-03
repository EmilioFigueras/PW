<HTML>
	<HEAD>
		<TITLE>encuesta.php</TITLE>
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

			$res_preguntas = $conn->query("SELECT pregunta FROM Preguntas");
			$num_filas = $res_preguntas->num_rows;
			//$num_filas = mysql_num_rows($res_preguntas);

			echo "Filas: ". $num_filas . "<br>";
			/*for($i=1; $i<=$fil_preguntas; $i++){
				$preguntas[$i] = $conn->query("SELECT pregunta FROM Preguntas WHERE id=$i")
			}*/
			$res_preguntas->close();
			$conn->close();
		?>


		<div align="center">
			<h1>Bienvenido a la Encuesta de la Biblioteca</h1>
			<br>
			<h4>A continuacion, rellena la siguientes datos personales.</h2>
				
			<FORM METHOD="POST" ACTION="insertar.php">
				Tipo de usuario:<br>
				<SELECT NAME="Usuario">
					<option>PDI</option>
					<option>PAS</option>
					<option>Alumno</option>
				</SELECT><br><br>

				Sexo:<br>
				<SELECT NAME="Sexo">
					<option>Hombre</option>
					<option>Mujer</option>
				</SELECT><br><br>

				Edad:<br>
				<INPUT TYPE="TEXT" NAME="Edad"><br><br>

				Facultad a la que perteneces:<br>
				<SELECT NAME="Facultad">
					<option>Medicina</option>
					<option>Educacion</option>
					<option>Ciencias Sociales</option>
					<option>Derecho</option>
					<option>Filosofia y Letras</option>
					<option>Ciencias del Mar</option>
					<option>Ingenieria</option>
				</SELECT><br><br>

				Biblioteca que vas a evaluar:<br>
				<SELECT NAME="Biblioteca">
					<option>Medicina</option>
					<option>Educacion</option>
					<option>Ciencias Sociales</option>
					<option>Derecho</option>
					<option>Filosofia y Letras</option>
					<option>Ciencias del Mar</option>
					<option>Ingenieria</option>
				</SELECT><br><br>

				<INPUT TYPE="SUBMIT" value="Terminar">
			</FORM>
		</div>
	</BODY>
</HTML>  
