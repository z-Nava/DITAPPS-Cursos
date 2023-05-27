<x-layout bodyClass="g-sidenav-show bg-gray-200">
  <x-navbars.sidebar activePage="Gestion de cursos"></x-navbars.sidebar>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
      <!-- Navbar -->
      <x-navbars.navs.auth titlePage="Gestion de cursos"></x-navbars.navs.auth>

      <div class="container-fluid py-4 ">
          <div class="row">
              <div class="col-12">
                  <h2>Mis cursos</h2>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearSemestreModal">
                      Agregar Semestre
                  </button>                    
                  <div class="rounded p-3 bg-light">
                      <div class="accordion" id="cursosAccordion">
                          @foreach ($cursos as $curso)
                              <div class="accordion-item shadow-lg bg-light my-3">
                                  <h2 class="accordion-header bg-dark text-light p-2 rounded">
                                      <button class="accordion-button collapsed text-light" type="button" data-bs-toggle="collapse" data-bs-target="#semestresCollapse{{ $curso->id }}" aria-expanded="false" aria-controls="semestresCollapse{{ $curso->id }}">
                                          Curso {{ $curso->nombre }}
                                      </button>
                                  </h2>
                                  <div id="semestresCollapse{{ $curso->id }}" class="accordion-collapse collapse" data-bs-parent="#cursosAccordion">
                                      @foreach ($curso->semestres as $semestre)
                                          <div class="accordion-body bg-white">
                                              <div class="accordion-item">
                                                  <h2 class="accordion-header bg-secondary text-light p-2 rounded">
                                                      <button class="btn btn-warning my-2" data-bs-toggle="modal" data-bs-target="#crearTemaModal{{ $curso->id }}{{ $semestre->id }}">
                                                          Agregar Tema
                                                      </button>
                                                      <button class="accordion-button collapsed text-light" type="button" data-bs-toggle="collapse" data-bs-target="#temasCollapse{{ $curso->id }}{{ $semestre->id }}" aria-expanded="false" aria-controls="temasCollapse{{ $curso->id }}{{ $semestre->id }}">
                                                          Semestre {{ $semestre->nombre }}
                                                      </button>
                                                  </h2>
                                                  <div id="temasCollapse{{ $curso->id }}{{ $semestre->id }}" class="accordion-collapse collapse" data-bs-parent="#semestresCollapse{{ $curso->id }}">
                                                      <div class="accordion-body bg-white">
                                                          @foreach ($semestre->temas as $tema)
                                                              <div class="p-2 bg-light border rounded my-2">
                                                                  <h5>{{ $tema->nombre }}</h5>
                                                                  <p>{{ $tema->descripcion }}</p>
                                                              <div class="ms-auto text-end">          
                                                                  <a class="btn btn-link text-dark px-3 mb-2" href="#" data-bs-toggle="modal" data-bs-target="#crearActividadModal" data-tema-id="{{ $tema->id }}">
                                                                      <i class="material-icons text-sm me-2">assignment</i>Tarea
                                                                  </a>
                                                                  <a class="btn btn-link text-dark px-3 mb-2" href="#">
                                                                      <i class="material-icons text-sm me-2">assignment_turned_in</i>Examen
                                                                  </a>
                                                                  <a class="btn btn-link text-dark px-3 mb-2" href="#">
                                                                      <i class="material-icons text-sm me-2">link</i>Link
                                                                  </a>
                                                                  <a class="btn btn-link text-dark px-3 mb-2" href="#">
                                                                      <i class="material-icons text-sm me-2">play_circle</i>Video
                                                                  </a>
                                                                  <a class="btn btn-link text-dark px-3 mb-2" href="#">
                                                                      <i class="material-icons text-sm me-2">attachment</i>Archivo
                                                                  </a>
                                                                  <a class="btn btn-link text-dark px-3 mb-2" href="#">
                                                                      <i class="material-icons text-sm me-2">edit</i>Editar
                                                                  </a>
                                                                  <a class="btn btn-link text-danger text-gradient px-3 mb-2" href="#">
                                                                      <i class="material-icons text-sm me-2">delete</i>Eliminar
                                                                      </a>
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
                          @endforeach
                      </div>                        
                  </div>
              </div>
          </div>
      </div>
        <!-- AQUI ACABA EL AGREGAR SEMESTRE -->

        <!-- Modal para Agregar Tema -->
        <div class="modal fade" id="crearTemaModal" tabindex="-1" aria-labelledby="crearTemaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearTemaModalLabel">Agregar Tema</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('gestion-cursos.storeTema') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="semestre" class="form-label">Semestre</label>
                                <select class="form-select" id="semestre" name="semestre_id" required>
                                    @foreach ($cursos as $curso)
                                        @foreach ($curso->semestres as $semestre)
                                            @if ($semestre->estado == 'activo')
                                                <option value="{{ $semestre->id }}">{{ $semestre->nombre }}</option>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nombreTema" class="form-label">Nombre del Tema</label>
                                <input type="text" class="form-control" id="nombreTema" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="contenidoTema" class="form-label">Contenido del Tema</label>
                                <textarea class="form-control" id="contenidoTema" name="contenido" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="enlaceTema" class="form-label">Enlace</label>
                                <input type="text" class="form-control" id="enlaceTema" name="enlace" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Crear Tema</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal para Agregar Actividad -->
        <!-- Modal Actividad -->
        <div class="modal fade" id="crearActividadModal" tabindex="-1" role="dialog" aria-labelledby="crearActividadModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="crearActividadModalLabel">Crear Actividad/tarea</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="{{ route('guardarTarea') }}" method="POST">
                  @csrf
                  <div class="modal-body">
                    <!-- Aquí puedes poner los campos necesarios para la actividad -->
                    <input type="hidden" id="temaIdInput" name="tema_id" value="{{ $tema->id }}">
                    <div class="form-group">
                      <label for="titulo">Titulo</label>
                      <input type="text" class="form-control" id="titulo" name="titulo" required>
                    </div>
                    <div class="form-group">
                      <label for="contenido">Contenido</label>
                      <textarea class="form-control" id="contenido" name="contenido" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="fecha_entrega">Fecha de entrega</label>
                      <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required min="{{ date('Y-m-d')}}">
                    </div>
                    <!-- Añade aquí más campos según lo necesites -->
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar Actividad</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Calificar Actividad -->
          @foreach ($entregas as $entrega)
          <div class="modal fade" id="calificarModal{{ $entrega->id }}" tabindex="-1" aria-labelledby="calificarModalLabel{{ $entrega->id }}" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title" id="calificarModalLabel{{ $entrega->id }}">Calificar entrega</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                      </div>
                      <div class="modal-body">
                          <form action="{{ route('gestion-cursos.calificarEntrega', $entrega->id) }}" method="POST">
                              @csrf
                              <div class="mb-3">
                                  <label for="calificacion{{ $entrega->id }}" class="form-label">Calificación</label>
                                  <input type="number" class="form-control" id="calificacion{{ $entrega->id }}" name="calificacion" min="0" max="100" required>
                              </div>
                              <!-- Agrega aquí otros campos o comentarios para la calificación -->
                              <button type="submit" class="btn btn-primary">Guardar calificación</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      @endforeach
    </div>     
    <div class="modal fade" id="editarModal{{ $tema->id }}" tabindex="-1" aria-labelledby="editarModalLabel{{ $tema->id }}" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editarModalLabel{{ $tema->id }}">Editar tema</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
              <!-- Formulario de edición -->
              <form action="{{ route('gestion-cursos.editarTema', $tema->id) }}" method="PUT">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="nombre{{ $tema->id }}" class="form-label">Nombre</label>
                  <input type="text" class="form-control" id="nombre{{ $tema->id }}" name="nombre" value="{{ $tema->nombre }}" required>
                </div>
                <div class="mb-3">
                  <label for="contenido{{ $tema->id }}" class="form-label">Contenido</label>
                  <textarea class="form-control" id="contenido{{ $tema->id }}" name="contenido" required>{{ $tema->contenido }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="enlace{{ $tema->id }}" class="form-label">Enlace</label>
                    <input type="text" class="form-control" id="enlace{{ $tema->id }}" name="enlace" value="{{ $tema->enlace }}" required>
                </div>

                <!-- Agrega aquí otros campos para editar el tema -->
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </main>


    <x-plugins></x-plugins>
</x-layout>

