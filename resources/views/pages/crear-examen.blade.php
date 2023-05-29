<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="Gestion de cursos"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Gestion de actividades"></x-navbars.navs.auth>

        <div class="row">
            <div class="col-lg-12">
                <!-- Primer div -->
                <div class="card h-100 mt-3">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Crear examen</h6>
                            </div>
                            <div class="col-6 text-end">
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 pb-0">
                        <div class="row">
                            <div class="col-6">
                                <div id="sub-table-actions" class="input-group input-group-outline mb-3">
                                    <label for="titulo" class="form-label">Título del Examen:</label>
                                    <input type="text" id="titulo" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div id="sub-table-actions" class="input-group input-group-outline mb-3">
                                    <label for="fecha_entrega">Fecha de entrega:</label>
                                    <input type="date" id="fecha_entrega" class="form-control" name="fecha_entrega"
                                        required>

                                </div>
                            </div>
                        </div>
                        <div id="preguntas">
                            <div class="pregunta">
                                <div class="row">
                                    <div class="col-4">
                                        <div id="sub-table-actions" class="input-group input-group-outline mb-3">
                                            <input type="text" id="pregunta-0" name="preguntas[]"
                                                placeholder="Pregunta" class="form-control pregunta-input" required>
                                        </div>
                                    </div>
                                    <div class="col-8 respuestas-content" id="respuestas-0">
                                        <div class="row">
                                            <div class="col-8">
                                                <div id="sub-table-actions"
                                                    class="input-group input-group-outline mb-3">
                                                    <input type="text" id="respuesta-0" name="respuestas[]"
                                                        placeholder="Respuesta" class="form-control respuesta-input"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="preguntasVerdaderas-0">
                                                    <label class="custom-control-label"
                                                        for="customCheck1">Correcta</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <button class="btn btn-primary" onclick="add_option(0)">Agregar opcion</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div id="preguntas">
                                <div class="pregunta">
                                    <label for="pregunta-0 pregunta-input">Pregunta:</label>
                                    <input type="text" id="pregunta-0" name="preguntas[]" required>
                                    <label for="respuesta-0 respuesta-input">Respuesta:</label>
                                    <input type="text" id="respuesta-0" name="respuestas[]" required>
                                </div>
                            </div> --}}
                        <button class="btn btn-primary" type="button" id="add-pregunta">Añadir pregunta</button>
                        <button class="btn btn-success" type="submit" onclick="sendTest(this)">Crear Examen</button>

                        <form action="{{ route('crearExamenApi') }}" id="send_exam_form" method="POST">
                            <input type="hidden" id="titulo_hidden" name="titulo" value="">
                            <input type="hidden" id="tema_id_hidden" name="tema_id" value="{{ $tema->id }}">
                            <input type="hidden" id="preguntas_hidden" name="preguntas" value="">
                            <input type="hidden" id="fecha_entrega_hidden" name="fecha_entrega" value="">
                        </form>


                    </div>
                </div>
            </div>


    </main>
    <x-plugins></x-plugins>
</x-layout>

<script>
    var enviar = false;
    var preguntaCount = 0;
    var dataImportant = {
        "titulo": "examen unidad 1",
        "tema_id": {{ $tema->id }},
        "preguntas": []
    }
    var respuestasCount = 0

    function add_option(p) {
        respuestasCount++;

        var respuestaDiv = document.createElement('div');
        respuestaDiv.className = 'row';
        respuestaDiv.innerHTML = `<div class="col-8">
                                      <div id="sub-table-actions"
                                          class="input-group input-group-outline mb-3">
                                          <input type="text" id="respuesta-${respuestasCount}" placeholder="Respuesta"
                                              name="respuestas[]" class="form-control respuesta-input" required>
                                      </div>
                                  </div>
                                  <div class="col-4">
                                      <div class="form-check">
                                          <input class="form-check-input" type="checkbox"
                                              id="preguntasVerdaderas-${respuestasCount}">
                                          <label class="custom-control-label"
                                              for="customCheck1">Correcta</label>
                                      </div>
                                  </div>`
        document.getElementById(`respuestas-${p}`).appendChild(respuestaDiv)
    }

    document.getElementById('add-pregunta').addEventListener('click', function() {
        preguntaCount++;
        respuestasCount++;
        var preguntaDiv = document.createElement('div');
        preguntaDiv.className = 'row';
        preguntaDiv.innerHTML = `<div class="col-4">
                                        <div id="sub-table-actions" class="input-group input-group-outline mb-3">
                                            <input type="text" id="pregunta-${preguntaCount}" name="preguntas[]" placeholder="Pregunta"
                                                class="form-control pregunta-input" required>
                                        </div>
                                    </div>
                                    <div class="col-8 respuestas-content" id="respuestas-${preguntaCount}">
                                        <div class="row">
                                            <div class="col-8">
                                                <div id="sub-table-actions"
                                                    class="input-group input-group-outline mb-3">
                                                    <input type="text" id="respuesta-${respuestasCount}" placeholder="Respuesta"
                                                        name="respuestas[]" class="form-control respuesta-input" required>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="preguntasVerdaderas-${respuestasCount}">
                                                    <label class="custom-control-label"
                                                        for="customCheck1">Correcta</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <button class="btn btn-primary" onclick="add_option(${preguntaCount})">Agregar opcion</button>
                                    </div>`

        document.getElementById('preguntas').appendChild(preguntaDiv)
    });

    function sendTest(boton) {
        if (!enviar) {
            index = 0;
            formulario = document.getElementById('preguntas')
            preguntas = formulario.querySelectorAll('.pregunta-input')
            preguntasList = []
            respuestaContent = formulario.querySelectorAll('.respuestas-content')
            respuestaContent.forEach(q => {
                respuestas = q.querySelectorAll('.respuesta-input')
                correcta = q.querySelectorAll('.form-check-input')
                opcionesList = []
                correcta_index = 0;
                respuestas.forEach(res => {
                    opcionesList.push({
                        "respuesta": res.value,
                        // "correcta":"nooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo"
                        "correcta": correcta[correcta_index].checked
                    })
                    correcta_index++;
                });
                preguntasList.push({
                    "pregunta": preguntas[index].value,
                    "tipo": "abierta",
                    "opciones": opcionesList
                })
            });
            document.getElementById('titulo_hidden').value = document.getElementById('titulo').value
            document.getElementById('tema_id_hidden').value = {{ $tema->id }}
            document.getElementById('preguntas_hidden').value = JSON.stringify(preguntasList);
            document.getElementById('fecha_entrega_hidden').value = document.getElementById('fecha_entrega').value
            enviar = true;
            boton.setAttribute('form', 'send_exam_form')
            boton.click();
        }
    }
</script>
