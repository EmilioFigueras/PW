<HTML>
	<HEAD>
		<TITLE>Encuesta de satisfacción de la Biblioteca.</TITLE>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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

			$hora_inicio = date("H:i:s");

			//$conn->close();
		?>





		<div align="center">
			<h1>Bienvenido a la Encuesta de la Biblioteca</h1>
			<br>
			<FORM METHOD="POST" ACTION="insertar.php?var=<?php echo base64_encode($hora_inicio); ?>" enctype="multipart/form-data"> <!-- Pasamos por metodo GET la hora de inicio codificada -->
				<?php
					$cons_dim = $conn->query("SELECT * FROM Dimensiones WHERE id_Estudios = '1'"); //Sacamos las dimensiones de nuestro estudio (solo tenemos 1, biblioteca)
					while($dim = $cons_dim->fetch_array()){
						echo "<h3>".$dim['nombre']."</h3>"; //Nombre de la dimension
						$cons_preg = $conn->query("SELECT * FROM Preguntas WHERE id_Dimensiones = ".$dim['id']); //Sacamos las preguntas de cada dimension
						while($preg = $cons_preg->fetch_array()){
							
							/*Tipos de las preguntas: 
								-user
								-sexo
								-campo_int
								-Facultad
								-Puntuar
								-Sugerencia
							*/
							echo $preg['pregunta']."<br>";
							//Ahora mostraremos las opciones de la pregunta dependiendo del tipo de esta
							if($preg['tipo'] == "user"){
								echo "<SELECT NAME=".$preg['abbr'].">
										<option>PDI</option>
										<option>PAS</option>
										<option>Alumno</option>
									  </SELECT><br><br>";
							}elseif($preg['tipo'] == "sexo"){
								echo "<SELECT NAME=".$preg['abbr'].">
										<option>Hombre</option>
										<option>Mujer</option>
									  </SELECT><br><br>";
							}elseif($preg['tipo'] == "campo_int"){
								echo "<INPUT TYPE='TEXT' NAME=".$preg['abbr']."><br><br>";
							}elseif($preg['tipo'] == "Facultad"){
								echo "<SELECT NAME=".$preg['abbr'].">
										<option>Medicina</option>
										<option>Educacion</option>
										<option>Ciencias Sociales</option>
										<option>Derecho</option>
										<option>Filosofia y Letras</option>
										<option>Ciencias del Mar</option>
										<option>Ingenieria</option>
									  </SELECT><br><br>";
							}elseif($preg['tipo'] == "Puntuar"){
								echo "<SELECT NAME=".$preg['abbr'].">
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
									  </SELECT><br><br>";
							}elseif($preg['tipo'] == "Sugerencia"){
								echo "<br><br><textarea name=".$preg['abbr']." rows='10' cols='40' placeholder='Escribe tu comentario....'></textarea> 
									  <br><br>";
							}
						}//fin while preguntas
						$cons_preg->free_result(); //Liberamos el resultado de preguntas
					}//fin while dimensiones
					$cons_dim->free_result(); //Liberamos el resultado de dimensiones
					$conn->close();
				?>
				<INPUT TYPE="SUBMIT" value="Terminar">
			</FORM>
		</div>
	</BODY>
</HTML>  
