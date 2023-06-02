<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <!-- End Navbar -->          

        <div class="container mt-4 col-lg-12">
            <div class="accordion" id="cursosAccordion">
                @foreach($cursos as $curso)
                    <div class="card mb-4">
                        <div class="card-header" id="curso{{$curso->id}}">
                            <h3 class="mb-0">
                                <form method="POST" action="{{ route('salirCurso', $curso) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-warning" onclick="return confirmarSalida()">Salir de curso</button>
                                </form>                                
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCurso{{$curso->id}}" aria-expanded="true" aria-controls="collapseCurso{{$curso->id}}">
                                    <h5>{{ $curso->nombre }}</h5> <h5>PROFESOR: {{ $curso->descripcion }}</h5>
                                </button>
                            </h3>
                        </div>
                        <div id="collapseCurso{{$curso->id}}" class="collapse bg-primary" aria-labelledby="curso{{$curso->id}}" data-bs-parent="#cursosAccordion">
                            <div class="card-body bg-primary">
                                
                                <div class="accordion" id="semestreAccordion{{$curso->id}}">
                                    @foreach ($curso->semestres as $semestre)
                                        <div class="card mb-3">
                                            <div class="card-header " id="semestre{{$semestre->id}}">
                                                <h4 class="mb-0">
                                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSemestre{{$semestre->id}}" aria-expanded="true" aria-controls="collapseSemestre{{$semestre->id}}">
                                                        Semestre: {{ $semestre->nombre }}
                                                    </button>
                                                </h4>
                                            </div>
                                            <div id="collapseSemestre{{$semestre->id}}" class="collapse" aria-labelledby="semestre{{$semestre->id}}" data-bs-parent="#semestreAccordion{{$curso->id}}">
                                                <div class="card-body">
                                                    <div class="accordion" id="temaAccordion{{$semestre->id}}">
                                                        @foreach ($semestre->temas as $tema)
                                                            <div class="card mb-2">
                                                                <div class="card-header" id="tema{{$tema->id}}">
                                                                    <h5 class="mb-0">
                                                                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTema{{$tema->id}}" aria-expanded="true" aria-controls="collapseTema{{$tema->id}}">
                                                                            Nombre del tema: {{ $tema->nombre }}
                                                                        </button>
                                                                        <h4>Contenido del tema: {{$tema->contenido}}</h4>
                                                                        <h5>Enlace de apoyo: <a href="{{ $tema->enlace }}">{{ $tema->enlace }}</a></h5>
                                                                         <!-- Insertamos los recursos relacionados a cada tema aquí -->
                                                                        @foreach($tema->recursos as $recurso)
                                                                        <div>
                                                                            <h6>{{ $recurso->tipo }} - {{ $recurso->titulo }}</h6>
                                                                            <div style="text-align: right">
                                                                                @if ($recurso->tipo === 'archivo')
                                                                                    <a href="{{ $recurso->archivo_url }}" target="_blank">
                                                                                        <span class="material-icons">description</span>Ver Archivo
                                                                                    </a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                    <!-- Fin de la inserción de recursos -->
                                                                    </h5>
                                                                </div>
                                                                <div id="collapseTema{{$tema->id}}" class="collapse" aria-labelledby="tema{{$tema->id}}" data-bs-parent="#temaAccordion{{$semestre->id}}">
                                                                    <div class="card-body bg-primary">
                                                                        @foreach($tema->recursos as $recurso)
                                                                            @if($recurso->tipo == 'tarea' && $recurso->estado == 'activo')
                                                                            @if(!auth()->user()->haCompletado($recurso))
                                                                                <div class="card mt-3">
                                                                                    <div class="card-header">
                                                                                        <h5 class="mb-0">{{ $recurso->titulo }}</h5>
                                                                                    </div>
                                                                                    <div class="card-body">
                                                                                        <p>{{ $recurso->contenido }}</p>
                                                                                        <p>Fecha de entrega: {{ $recurso->fecha_entrega }}</p>

                                                                                        <!-- Añade esto si el recurso tiene un archivo asociado -->
                                                                                            @if($recurso->archivo_url)
                                                                                            <a href="{{ route('recurso.verArchivo', $recurso->id) }}" target="_blank">Ver archivo adjunto</a>
                                                                                        @endif
                                                                            
                                                                                        <form action="{{ route('entregarTarea') }}" method="post" enctype="multipart/form-data">
                                                                                            @csrf
                                                                                            <input type="hidden" name="recurso_id" value="{{ $recurso->id }}">
                                                                                            <div class="mb-3">
                                                                                                <label for="descripcion" class="form-label">Comentario</label>
                                                                                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                                                                                            </div>
                                                                                            <div class="mb-3">
                                                                                                <label for="archivo" class="form-label">Subir Archivo</label>
                                                                                                <input class="form-control" type="file" id="archivo" name="archivo">
                                                                                            </div>
                                                                                            <button type="submit" class="btn btn-primary">Entregar tarea</button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                            @endif
                                                                            @if($recurso->tipo == 'examen' && $recurso->estado == 'activo' && 
                                                                            \Carbon\Carbon::now()->between(new \Carbon\Carbon($recurso->fecha_inicio), new \Carbon\Carbon($recurso->fecha_fin)))
                                                                            
                                                                            @if(!auth()->user()->haCompletado($recurso))
                                                                                <div class="card mt-3">
                                                                                    <div class="card-header">
                                                                                        <h5 class="mb-0">{{ $recurso->titulo }}</h5>
                                                                                    </div>
                                                                                    <div class="card-body">
                                                                                        <p>{{ $recurso->contenido }}</p>
                                                                                        <p>Fecha de entrega: {{ $recurso->fecha_entrega }}</p>
                                                                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormularioExamen{{ $recurso->id }}">
                                                                                            Mostrar Formulario
                                                                                          </button>
                                                                                          <script>
                                                                                            @foreach($tema->recursos as $recurso)
                                                                                                if($recurso->tipo == 'examen' && $recurso->estado == 'activo') {
                                                                                                    if(!auth()->user()->haCompletado($recurso)) {
                                                                                                        document.getElementById('mostrarFormulario{{ $recurso->id }}').addEventListener('click', function() {
                                                                                                            var form = document.getElementById('formularioExamen{{ $recurso->id }}');
                                                                                                            if (form.style.display === 'none') {
                                                                                                                form.style.display = 'block';
                                                                                                            } else {
                                                                                                                form.style.display = 'none';
                                                                                                            }
                                                                                                        });
                                                                                                    }
                                                                                                }
                                                                                            @endforeach
                                                                                        </script>
                                                                                          <div class="modal fade" id="modalFormularioExamen{{ $recurso->id }}" tabindex="-1" aria-labelledby="modalFormularioExamen{{ $recurso->id }}Label" aria-hidden="true">
                                                                                            <div class="modal-dialog">
                                                                                              <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                  <h5 class="modal-title" id="modalFormularioExamen{{ $recurso->id }}Label">{{ $recurso->titulo }}</h5>
                                                                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                  <form action="{{ route('entregarExamen') }}" method="post" enctype="multipart/form-data">
                                                                                                    @csrf
                                                                                                    <input type="hidden" name="recurso_id" value="{{ $recurso->id }}">
                                                                                                    @foreach($recurso->preguntas as $pregunta)
                                                                                                      <div class="mb-3">
                                                                                                        <label class="form-label">{{ $pregunta->pregunta }}</label>
                                                                                                        {{-- @if($pregunta->tipo == 'abierta')
                                                                                                          <textarea class="form-control" name="respuesta-{{ $pregunta->id }}" rows="3"></textarea>
                                                                                                        @else --}}
                                                                                                          @foreach($pregunta->respuestas as $respuesta)
                                                                                                            <div class="form-check">
                                                                                                              <input class="form-check-input" type="radio" name="respuesta-{{ $pregunta->id }}" value="{{ $respuesta->id }}">
                                                                                                              <label class="form-check-label">{{ $respuesta->respuesta }}</label>
                                                                                                            </div>
                                                                                                          @endforeach
                                                                                                        {{-- @endif --}}
                                                                                                      </div>
                                                                                                    @endforeach
                                                                                                    <button type="submit" class="btn btn-success">Enviar respuestas</button>
                                                                                                  </form>
                                                                                                </div>
                                                                                              </div>
                                                                                            </div>
                                                                                          </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        @endif                                                                        
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <script>
            function confirmarSalida() {
                console.log('entro al aviso');
                return confirm('¿Estás seguro de que quieres salir de este curso?, por favor, antes de hacer esto, asegurate de haberlo consultado con tu profesor.');
            }
            </script>
            
    </main>
</x-layout>
