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
                                                                    <a class="btn btn-link text-dark px-3 mb-2" href="#"><i class="material-icons text-sm me-2">edit</i>Editar</a>
                                                                    <a class="btn btn-link text-dark px-3 mb-2" href="#"><i class="material-icons text-sm me-2">visibility</i>Ver</a>
                                                                    <a class="btn btn-link text-dark px-3 mb-2" href="#"><i class="material-icons text-sm me-2">forum</i>Foro</a>
                                                                    <a class="btn btn-link text-danger text-gradient px-3 mb-2" href="#"><i class="material-icons text-sm me-2">delete</i>Eliminar</a>
                                                                    <a class="btn btn-link text-dark px-3 mb-2" href="#"><i class="material-icons text-sm me-2">assignment</i>Tarea</a>
                                                                    <a class="btn btn-link text-dark px-3 mb-2" href="#"><i class="material-icons text-sm me-2">forum</i>Foro</a>
                                                                    <a class="btn btn-link text-dark px-3 mb-2" href="#"><i class="material-icons text-sm me-2">assignment_turned_in</i>Examen</a>
                                                                    <a class="btn btn-link text-dark px-3 mb-2" href="#"><i class="material-icons text-sm me-2">link</i>Link</a>
                                                                    <a class="btn btn-link text-dark px-3 mb-2" href="#"><i class="material-icons text-sm me-2">play_circle</i>Video</a>
                                                                    <a class="btn btn-link text-dark px-3 mb-2" href="#"><i class="material-icons text-sm me-2">attachment</i>Archivo</a>
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
                                    <button type="submit" class="btn btn-primary">Crear Tema</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endforeach

        <x-footers.auth></x-footers.auth>
    </main>
    <x-plugins></x-plugins>
</x-layout>
