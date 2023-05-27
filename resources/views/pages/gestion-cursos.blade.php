<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="Gestion de cursos"></x-navbars.sidebar>
    
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Gestion de cursos"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4 ">
            <div class="row">
                <div class="col-12">
                    <h2>Mis cursos</h2>
                    <div>
                        @foreach ($cursos as $curso)
                        @foreach ($curso->semestres as $semestre)
                        <button class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#crearSemestreModal">Crear Semestre</button>
                        @endforeach
                        @endforeach
                        <button class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#crearTemaModal{{ $curso->id }}{{ $semestre->id }}">Crear Tema</button>
                        
                        <button class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#crearActividadModal">Crear Tarea</button>
                        
                      </div>
                      <div class="row">
                        <div class="col-lg mt-4">
                          @foreach ($cursos as $curso)
                            @foreach ($curso->semestres as $semestre)
                              @if ($semestre->estado == 'activo')
                                <div class="card">
                                  <div class="card-header pb-0 px-3">
                                    <h6 class="mb-0">{{ $semestre->nombre }}</h6>
                                  </div>
                                  <div class="card-body pt-4 p-3">
                                    <ul class="list-group">
                                      @foreach ($semestre->temas as $tema)
                                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                          <div class="d-flex flex-column">
                                            <h6 class="mb-3 text-sm">{{ $tema->nombre }} - {{$tema->created_at}}</h6>
                                            <span class="mb-2 text-xs">Contenido: <span class="text-dark font-weight-bold ms-sm-2">{{ $tema->contenido }}</span></span>
                                            <span class="mb-2 text-xs">Enlace: <span class="text-dark font-weight-bold ms-sm-2">{{ $tema->enlace }}</span></span>
                                          </div>
                                          <div class="ms-auto text-end">
                                            <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">delete</i>Delete</a>
                                            <a class="btn btn-link text-dark px-3 mb-0" href="javascript:;"><i class="material-icons text-sm me-2">edit</i>Edit</a>
                                          </div>
                                        </li>
                                      @endforeach
                                    </ul>
                                  </div>
                                </div>
                              @endif
                            @endforeach
                          @endforeach
                        </div>
                      </div>
                            
                          </div>
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="card h-100 mt-3">
                              <div class="card-header pb-0 p-3">
                                <div class="row">
                                  <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Entregas de actividades</h6>
                                  </div>
                                  <div class="col-6 text-end">
                                  </div>
                                </div>
                              </div>
                              <div class="card-body p-3 pb-0">
                                <ul class="list-group">
                                    @foreach ($entregas as $entrega)
                                        <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-1 text-dark font-weight-bold text-sm">{{ $entrega->recurso->titulo }}</h6>
                                                <span class="text-xs">{{ $entrega->archivo }}</span>
                                                <span class="text-xs">Alumno: {{ $entrega->user_id }}</span>
                                            </div>
                                            <div class="d-flex align-items-center text-sm">
                                                {{ $entrega->descripcion }}
                                                <a href="{{ asset('storage/' . str_replace('public/', '', $entrega->archivo)) }}" target="_blank" class="btn btn-link text-dark text-sm mb-0 px-0 ms-4">
                                                    <i class="material-icons text-lg position-relative me-1">picture_as_pdf</i> Descargar PDF
                                                  </a>
                                                  <button class="btn btn-primary btn-sm mb-0 ms-4" data-bs-toggle="modal" data-bs-target="#calificarModal{{ $entrega->id }}">Calificar</button>                                               
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="col-lg mt-3">
                                <div class="card h-100">
                                    <div class="card-header pb-0 px-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="mb-0">Actividades encargadas</h6><button class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#crearActividadModal">Crear Tarea</button>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-start justify-content-md-end align-items-center">
                                                <i class="material-icons me-2 text-lg">date_range</i>
                                                <small>23 - 30 March 2020</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-4 p-3">
                                        <h6 class="text-uppercase text-body text-xs font-weight-bolder mb-3">Newest</h6>
                                        <ul class="list-group">
                                            @foreach ($recursos as $recurso)
                                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                <div class="d-flex align-items-center">
                                                    <button class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center">
                                                        <i class="material-icons text-lg">expand_more</i>
                                                    </button>
                                                    <div class="d-flex flex-column">
                                                        <h5 class="mb-1 text-dark text-sm">{{ $recurso->tipo }}</h5>
                                                        <h6 class="mb-1 text-dark text-sm">{{ $recurso->titulo }}</h6>
                                                        <span class="text-xs">{{ $recurso->fecha_entrega}}</span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                                    {{ $recurso->estado }}
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        </div>
                    </div>
                        
        <x-footers.auth></x-footers.auth>
        <!-- Agregar Semestre -->
        <div class="modal fade" id="crearSemestreModal" tabindex="-1" aria-labelledby="crearSemestreModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearSemestreModalLabel">Agregar Semestre</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('gestion-cursos.store') }}" method="POST">

                            @csrf
                            <div class="mb-3">
                                <label for="curso" class="form-label">Curso</label>
                                <select class="form-select" id="curso" name="curso_id" required>
                                    @foreach ($cursos as $cursoOption)
                                        <option value="{{ $cursoOption->id }}">{{ $cursoOption->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Semestre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                                <input type="date" class="form-control" id="fechaInicio" name="fecha_inicio" required min="{{ date('Y-m-d') }}">
                            </div>
                            <div class="mb-3">
                                <label for="fechaFin" class="form-label">Fecha de Fin</label>
                                <input type="date" class="form-control" id="fechaFin" name="fecha_fin" required min="{{ date('Y-m-d') }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Crear Semestre</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- AQUI ACABA EL AGREGAR SEMESTRE -->

        <!-- Modal para Agregar Tema -->
        @foreach ($cursos as $curso)
            @foreach ($curso->semestres as $semestre)
                <div class="modal fade" id="crearTemaModal{{ $curso->id }}{{ $semestre->id }}" tabindex="-1" aria-labelledby="crearTemaModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="crearTemaModalLabel">Agregar Tema</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('gestion-cursos.storeTema') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="semestre_id" value="{{ $semestre->id }}">

                                    <div class="mb-3">
                                        <label for="nombreTema{{ $curso->id }}{{ $semestre->id }}" class="form-label">Nombre del Tema</label>
                                        <input type="text" class="form-control" id="nombreTema{{ $curso->id }}{{ $semestre->id }}" name="nombre" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="contenidoTema{{ $curso->id }}{{ $semestre->id }}" class="form-label">Contenido del Tema</label>
                                        <textarea class="form-control" id="contenidoTema{{ $curso->id }}{{ $semestre->id }}" name="contenido" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="contenidoTema{{ $curso->id }}{{ $semestre->id }}" class="form-label">Enlace</label>
                                        <input type="text" class="form-control" id="enlaceTema{{ $curso->id }}{{ $semestre->id }}" name="enlace" required>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Crear Tema</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach

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
        <div class="col-6 text-end">
            <button class="btn btn-outline-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#calificarModal{{ $entrega->id }}">Calificar</button>
        </div>
    @endforeach
    </div>

    
          
    </main>

    
    <x-plugins></x-plugins>
</x-layout>
