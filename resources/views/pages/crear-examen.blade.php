<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejemplo Examen</title>
    <script>
        var preguntaCount = 0;
      
        document.getElementById('add-pregunta').addEventListener('click', function() {
          preguntaCount++;
          var preguntaDiv = document.createElement('div');
          preguntaDiv.className = 'pregunta';
          preguntaDiv.innerHTML = `
            <label for="pregunta-${preguntaCount}">Pregunta:</label>
            <input type="text" id="pregunta-${preguntaCount}" name="preguntas[]" required>
            <label for="respuesta-${preguntaCount}">Respuesta:</label>
            <input type="text" id="respuesta-${preguntaCount}" name="respuestas[]" required>
          `;
          document.getElementById('preguntas').appendChild(preguntaDiv);
        });
      </script>
</head>
<body>
    <div class="container">
        <h2>Crear Examen</h2>
        <form action="/gestion-cursos/crear-examen" method="POST">
          @csrf
          <label for="titulo">Título del Examen:</label>
          <input type="text" id="titulo" name="titulo" required>
          <label for="tipo">Tipo de examen:</label>
          <select id="tipo" name="tipo" required>
              <option value="pregunta_abierta">Pregunta abierta</option>
              <option value="opcion_multiple">Opción múltiple</option>
          </select>
          <label for="fecha_entrega">Fecha de entrega:</label>
          <input type="date" id="fecha_entrega" name="fecha_entrega" required>
          <div id="preguntas">
            <div class="pregunta">
              <label for="pregunta-0">Pregunta:</label>
              <input type="text" id="pregunta-0" name="preguntas[]" required>
              <label for="respuesta-0">Respuesta:</label>
              <input type="text" id="respuesta-0" name="respuestas[]" required>
            </div>
          </div>
          <button type="button" id="add-pregunta">Añadir pregunta</button>
          <button type="submit">Crear Examen</button>
        </form>
      </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</html>