<HTML>
	<HEAD>
		<TITLE>encuesta.php</TITLE>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

			$res_preguntas = $conn->query("SELECT pregunta FROM Preguntas");
			$num_filas = $res_preguntas->num_rows;
			$res_preguntas->close();

			//Almacenamos cada pregunta en el vector preguntas[]
			for($i=1; $i<=$num_filas; $i++){
				$consulta_pre[$i] = $conn->query("SELECT pregunta FROM Preguntas WHERE id=$i");
				while($row = $consulta_pre[$i]->fetch_array())
					$preguntas[$i] = $row[0];
			}

			$hora_inicio = date("H:i:s");

			$conn->close();
		?>


		<div align="center">
			<h1>Bienvenido a la Encuesta de la Biblioteca</h1>
			<br>
			<FORM METHOD="POST" ACTION="insertar.php?var=<?php echo base64_encode($hora_inicio); ?>"> <!-- Pasamos por metodo GET la hora de inicio codificada -->
				<h3>A continuacion, rellena la siguientes datos personales.</h3>
				<?php echo $preguntas[1]; ?><br>
				<SELECT NAME="Usuario">
					<option>PDI</option>
					<option>PAS</option>
					<option>Alumno</option>
				</SELECT><br><br>

				<?php echo $preguntas[2]; ?><br>
				<SELECT NAME="Sexo">
					<option>Hombre</option>
					<option>Mujer</option>
				</SELECT><br><br>

				<?php echo $preguntas[3]; ?><br>
				<INPUT TYPE="TEXT" NAME="Edad"><br><br>

				<?php echo $preguntas[4]; ?><br>
				<SELECT NAME="Facultad">
					<option>Medicina</option>
					<option>Educacion</option>
					<option>Ciencias Sociales</option>
					<option>Derecho</option>
					<option>Filosofia y Letras</option>
					<option>Ciencias del Mar</option>
					<option>Ingenieria</option>
				</SELECT><br><br>

				<?php echo $preguntas[5]; ?><br>
				<SELECT NAME="Biblioteca">
					<option>Medicina</option>
					<option>Educacion</option>
					<option>Ciencias Sociales</option>
					<option>Derecho</option>
					<option>Filosofia y Letras</option>
					<option>Ciencias del Mar</option>
					<option>Ingenieria</option>
				</SELECT><br><br>

				<h3>Encuesta sobre el Personal de la Biblioteca</h3>
				<h6> El valor 1 equivale a INSATISFECHO y el valor 10 a MUY SATISFECHO</h6>
				<?php echo $preguntas[6]; ?>
				<SELECT NAME="Espera">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</SELECT><br><br>

				<?php echo $preguntas[7]; ?>
				<SELECT NAME="Trato">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</SELECT><br><br>

				<?php echo $preguntas[8]; ?>
				<SELECT NAME="Trabajadores">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</SELECT><br><br>

				<?php echo $preguntas[9]; ?>
				<SELECT NAME="Dudas">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</SELECT><br><br>


				<h3>Encuesta sobre las Salas y el Mobiliario de la Biblioteca</h3>
				<h6> El valor 1 equivale a INSATISFECHO y el valor 10 a MUY SATISFECHO</h6>
				<?php echo $preguntas[10]; ?>
				<SELECT NAME="Limpieza">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</SELECT><br><br>

				<?php echo $preguntas[11]; ?>
				<SELECT NAME="Estado_Mob">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</SELECT><br><br>


				<?php echo $preguntas[12]; ?>
				<SELECT NAME="Confort">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</SELECT><br><br>


				<?php echo $preguntas[13]; ?>
				<SELECT NAME="Salas">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</SELECT><br><br>


				<?php echo $preguntas[14]; ?>
				<SELECT NAME="Orden">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</SELECT><br><br>


				<h3>Encuesta sobre la Información disponible en la Biblioteca</h3>
				<h6> El valor 1 equivale a INSATISFECHO y el valor 10 a MUY SATISFECHO</h6>
				<?php echo $preguntas[15]; ?>
				<SELECT NAME="Cantidad">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</SELECT><br><br>


				<?php echo $preguntas[16]; ?>
				<SELECT NAME="Calidad">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</SELECT><br><br>

				<?php echo $preguntas[17]; ?>
				<SELECT NAME="Estado_Inf">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</SELECT><br><br>

				<?php echo $preguntas[18]; ?>
				<SELECT NAME="Renovacion">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</SELECT><br><br>

				<?php echo $preguntas[19]; ?>
				<SELECT NAME="Online">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
				</SELECT><br><br>
				<h3>Sugerencias</h3>
				<?php echo $preguntas[20]; ?>
				<br><br>
				<textarea name="Sugerencia" rows="10" cols="40">Escribe tu comentario....</textarea> 
				<br><br>

				<INPUT TYPE="SUBMIT" value="Terminar">
			</FORM>
		</div>
	</BODY>
</HTML>  
