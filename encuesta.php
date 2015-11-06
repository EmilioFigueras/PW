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

			/*$res_preguntas = $conn->query("SELECT pregunta FROM Preguntas");
			$num_filas = $res_preguntas->num_rows;
			$res_preguntas->close();

			//Almacenamos cada pregunta en el vector preguntas[]
			for($i=1; $i<=$num_filas; $i++){
				$consulta_pre[$i] = $conn->query("SELECT pregunta FROM Preguntas WHERE id=$i");
				while($row = $consulta_pre[$i]->fetch_array())
					$preguntas[$i] = $row[0];
			}*/

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

					}//fin while dimensiones
				?>
				<INPUT TYPE="SUBMIT" value="Terminar">
			</FORM>
		</div>
		<?php
		$preg->free_result(); //Liberamos el resultado de preguntas
		$dim->free_result(); //Liberamos el resultado de dimensiones
		$conn->close();
		?>
	</BODY>
</HTML>  
