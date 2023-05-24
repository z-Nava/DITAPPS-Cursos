<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="Gestion de cursos"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Gestion de cursos"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <h2>Mis cursos</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearSemestreModal">
                        Agregar Semestre
                    </button>                    
                    <div class="rounded p-3 bg-primary" >
                        <div class="accordion" id="cursosAccordion">
                            @foreach ($cursos as $curso)
                                @if ($curso->usuario->id === auth()->user()->id)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed text-dark text-end" type="button" data-bs-toggle="collapse" data-bs-target="#semestresCollapse{{ $curso->id }}" aria-expanded="false" aria-controls="semestresCollapse{{ $curso->id }}">
                                                {{ $curso->nombre }}
                                            </button>
                                        </h2>
                                        <div id="semestresCollapse{{ $curso->id }}" class="accordion-collapse collapse" data-bs-parent="#cursosAccordion">
                                            <div class="accordion-body bg-light">
                                                <div class="accordion" id="semestresAccordion{{ $curso->id }}">
                                                    @foreach ($curso->semestres as $semestre)
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header">
                                                                <button class="accordion-button collapsed text-dark text-end" type="button" data-bs-toggle="collapse" data-bs-target="#temasCollapse{{ $curso->id }}{{ $semestre->id }}" aria-expanded="false" aria-controls="temasCollapse{{ $curso->id }}{{ $semestre->id }}">
                                                                    Semestre {{ $semestre->nombre }}
                                                                </button>
                                                            </h2>
                                                            <div id="temasCollapse{{ $curso->id }}{{ $semestre->id }}" class="accordion-collapse collapse" data-bs-parent="#semestresAccordion{{ $curso->id }}">
                                                                <div class="accordion-body bg-white">
                                                                    <!-- Contenido del semestre -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
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
                        <form action="{{ route('gestion-cursos.store', $curso->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="curso" class="form-label">Curso</label>
                                <select class="form-select" id="curso" name="curso_id" required>
                                    @foreach (auth()->user()->cursos as $curso)
                                        <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Semestre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                                <input type="date" class="form-control" id="fechaInicio" name="fecha_inicio" required >
                            </div>
                            <div class="mb-3">
                                <label for="fechaFin" class="form-label">Fecha de Fin</label>
                                <input type="date" class="form-control" id="fechaFin" name="fecha_fin" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Crear Semestre</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- AQUI ACABA EL AGREGAR SEMESTRE -->
        <x-footers.auth></x-footers.auth>
    </main>
    <x-plugins></x-plugins>
</x-layout>


