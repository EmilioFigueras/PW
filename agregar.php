<html>
  <head>
    <title>Agregar una nueva pregunta para la Biblioteca</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>
  <body>
  	<h1>Insertar una nueva pregunta para la Encuesta de Satisfacción de la Biblioteca</h1>
  	<form method="POST" action="procesar.php?var1=<?php echo $_GET['var1']; ?>&var2=<?php echo $_GET['var2']; ?>">
  		<h3>Escriba su pregunta:</h3>
  		<textarea name='Pregunta' rows='5' cols='60' placeholder='Escribe aqui su pregunta...'></textarea><br><br>

  		<h3>Escriba una descripción de su pregunta: </h3>
  		<textarea name='Descripcion' rows='10' cols='60' placeholder='Escribe aqui la descripción...'></textarea><br><br>

  		<h3>Escriba una abreviatura identificativa (una única palabra o varias separadas por guiones bajos '_':)</h3>
  		<textarea name='Abbr' rows='2' cols='30' placeholder='Escribe aqui la descripción...'></textarea><br><br>

  		<h3>Indique el tipo de respuesta que se le puede dar a su pregunta: </h3>
  		<select name='Tipo'>
  			<option value='campo_int'>Números enteros</option>
  			<option value='Facultad'>Lista de facultades</option>
  			<option value='Puntuar'>Puntuación</option>
  			<option value='Sugerencia'>Texto</option>
  		</select><br><br>

      <h3>Indique la dimensión a la que pertenece la pregunta: </h3>
      <select name='Dimension'>
        <option value='1'>Información del usuario</option>
        <option value='2'>Sobre el personal de la biblioteca</option>
        <option value='3'>Sobre el mobiliario, salas de trabajo...</option>
        <option value='4'>Sobre la información disponible. </option>
        <option value='5'>Aporte de sugerencias, opiniones, quejas... </option>
      </select><br><br><br><br>
      <div align="center">
        <input type="SUBMIT" value="Enviar">
      </div>
    </form>
  </body>
</html>