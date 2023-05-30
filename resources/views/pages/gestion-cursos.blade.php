<x-layout bodyClass="g-sidenav-show bg-gray-200">
  <x-navbars.sidebar activePage="Gestion de cursos"></x-navbars.sidebar>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
      <!-- Navbar -->
      <x-navbars.navs.auth titlePage="Gestion de cursos"></x-navbars.navs.auth>

      <div class="container-fluid py-4 ">
        <div class="row">
            <div class="col-12">
                <h2>Mis cursos</h2>
                @if (Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2)
                <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#crearSemestreModal">
                  Crear nuevo semestre
                </button>
                @endif
                <div class="rounded p-3 bg-light">
                  @foreach ($cursos as $curso)
                @foreach ($curso->semestres as $semestre)  
                    <div class="accordion " id="cursosAccordion">
                                <div class="accordion-item shadow-lg bg-light my-3">
                                    <h2 class="accordion-header bg-dark text-light p-2 rounded">
                                        <button class="accordion-button collapsed text-light" type="button" data-bs-toggle="collapse" data-bs-target="#semestresCollapse{{ $curso->id }}{{ $semestre->id }}" aria-expanded="false" aria-controls="semestresCollapse{{ $curso->id }}{{ $semestre->id }}">
                                              Semestre {{ $semestre->nombre }}
                                        </button>
                                    </h2>
                                    <div id="semestresCollapse{{ $curso->id }}{{ $semestre->id }}" class="accordion-collapse collapse" data-bs-parent="#cursosAccordion">
                                        <div class="accordion-body bg-white">
                                            <div class="accordion-item ">
                                                <h2 class="accordion-header bg-secondary text-light p-2 rounded">
                                                  <button class="btn btn-warning my-2" data-bs-toggle="modal" data-bs-target="#crearTemaModal{{ $curso->id }}{{ $semestre->id }}">
                                                    Agregar Tema
                                                  </button>
                                                  <!--MODAL-->
                                                  <div class="modal fade" id="crearTemaModal{{ $curso->id }}{{ $semestre->id }}" tabindex="-1" role="dialog" aria-labelledby="crearTemaModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="crearTemaModalLabel">Agregar Tema</h5>
                                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                          <form action="{{ route('gestion-cursos.storeTema') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="curso_id" value="{{ $curso->id }}">
                                                            <input type="hidden" name="semestre_id" value="{{ $semestre->id }}">
                                                            <div class="mb-3">
                                                              <label for="nombre" class="form-label">Nombre</label>
                                                              <input type="text" class="form-control" id="nombre" name="nombre" required>
                                                            </div>
                                                            <div class="mb-3">
                                                              <label for="contenido" class="form-label">Contenido</label>
                                                              <textarea class="form-control" id="contenido" name="contenido" required></textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                              <label for="enlace" class="form-label">Enlace</label>
                                                              <input type="text" class="form-control" id="enlace" name="enlace">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Crear Tema</button>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  
                                                  <!--FIN MODAL-->
                                                    <button class="accordion-button collapsed text-light" type="button" data-bs-toggle="collapse" data-bs-target="#temasCollapse{{ $curso->id }}{{ $semestre->id }}" aria-expanded="false" aria-controls="temasCollapse{{ $curso->id }}{{ $semestre->id }}">
                                                      Curso {{ $curso->nombre }}
                                                    </button>
                                                </h2>
                                                <div id="temasCollapse{{ $curso->id }}{{ $semestre->id }}" class="accordion-collapse collapse" data-bs-parent="#semestresCollapse{{ $curso->id }}{{ $semestre->id }}">
                                                    <div class="accordion-body bg-white">
                                                        @foreach ($semestre->temas as $tema)
                                                            <div class="p-2 bg-light border rounded my-2">
                                                                <h5>{{ $tema->nombre }}</h5>
                                                                <p>{{ $tema->contenido }}</p>

                                                                @foreach ($tema->recursos as $recurso )
                                                                <hr>
                                                                  <div>
                                                                    <h6>{{ $recurso->tipo }} - {{ $recurso->titulo }}</h6>
                                                                    <div style="text-align: right">
                                                                      <p>Fecha de inicio: {{ $recurso->fecha_inicio }}</p>
                                                                      <p>Fecha de entrega: {{ $recurso->fecha_entrega }}</p>
                                                                    </div>
                                                                  </div>
                                                                @endforeach
                                                                <div class="ms-auto text-end">          
                                                                    <a class="btn btn-link text-dark px-3 mb-2 asignar-tarea-btn" href="#" data-bs-toggle="modal" data-bs-target="#crearActividadModal{{ $tema->id }}" data-tema-id="{{ $tema->id }}">
                                                                      
                                                                      <i class="material-icons text-sm me-2">assignment</i>Tarea
                                                                      
                                                                    </a>
                                                                    <a class="btn btn-link text-dark px-3 mb-2" href="gestion-cursos/{{ $tema->id }}/crear-examen">
                                                                        <i class="material-icons text-sm me-2">assignment_turned_in</i>Examen
                                                                    </a>
                                                                    <a class="btn btn-link text-dark px-3 mb-2" href="#">
                                                                        <i class="material-icons text-sm me-2">edit</i>Editar
                                                                    </a>
                                                                    <a class="btn btn-link text-danger text-gradient px-3 mb-2" href="#">
                                                                        <i class="material-icons text-sm me-2">delete</i>Eliminar
                                                                    </a>
                                                                </div>
                                                                <!--MODAL-->
                                                                <div class="modal fade" id="crearActividadModal{{ $tema->id }}" tabindex="-1" role="dialog" aria-labelledby="crearActividadModalLabel" aria-hidden="true">
                                                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                                                      <div class="modal-content">
                                                                          <div class="modal-header">
                                                                              <h5 class="modal-title" id="crearActividadModalLabel">Asignar Tarea</h5>
                                                                              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                              </button>
                                                                          </div>
                                                                          <form action="{{ route('guardarTarea') }}" method="POST">
                                                                              @csrf
                                                                              <div class="modal-body">
                                                                                <input type="hidden" id="temaIdInput{{ $tema->id }}" name="tema_id">
                                                                                  <div class="form-group">
                                                                                      <label for="titulo" class="text-start">Título</label>
                                                                                      <input type="text" class="form-control" id="titulo" name="titulo" required>
                                                                                  </div>
                                                                                  <div class="form-group">
                                                                                      <label for="contenido" class="text-start">Contenido</label>
                                                                                      <textarea class="form-control" id="contenido" name="contenido" rows="3" required></textarea>
                                                                                  </div>
                                                                                  <div class="form-group">
                                                                                      <label for="fecha_entrega" class="text-start">Fecha de entrega</label>
                                                                                      <input type="date" class="form-control" id="fecha_entrega" name="fecha_entrega" required min="{{ date('Y-m-d')}}">
                                                                                  </div>
                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                                  <button type="submit" class="btn btn-primary">Guardar Tarea</button>
                                                                              </div>
                                                                          </form>
                                                                      </div>
                                                                  </div>
                                                                </div>
                                                                <!--FIN MODAL-->
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>                        
                </div>
            </div>
        </div>
    </div>
    <!--MODAL-->
    <div class="modal fade" id="crearSemestreModal" tabindex="-1" role="dialog" aria-labelledby="crearSemestreModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="crearSemestreModalLabel">Crear nuevo semestre</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('gestion-cursos.store') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
              </div>
              <div class="mb-3">
                <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
              </div>
              <div class="mb-3">
                <label for="fecha_fin" class="form-label">Fecha de fin</label>
                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
              </div>
              <div class="mb-3">
                <label for="curso_id" class="form-label">Curso</label>
                <select class="form-select" id="curso_id" name="curso_id" required>
                  @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                  @endforeach
                </select>
              </div>
              <button type="submit" class="btn btn-primary">Crear semestre</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!--FIN MODAL-->         
    <script>
      

      document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('.asignar-tarea-btn').forEach(item => {
        item.addEventListener('click', event => {
            let temaId = event.currentTarget.getAttribute('data-tema-id');
            document.querySelector(`#temaIdInput${temaId}`).value = temaId;
        });
    });
});
    </script>
    
  </main>
    <x-plugins></x-plugins>
</x-layout>

