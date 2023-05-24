<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="Gestion de cursos"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Gestion de cursos"></x-navbars.navs.auth>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <h2>Mis cursos</h2>
                    <button class="btn btn-primary" data-toggle="collapse" data-target="#agregarSemestre" aria-expanded="false" aria-controls="agregarSemestre">
                        Agregar Semestre
                    </button>
                    <div class="rounded p-3 bg-primary" >
                        <div class="accordion" id="cursosAccordion" >
                            @foreach ($cursos as $curso)
                                @if ($curso->usuario->id === auth()->user()->id)
                                    <div class="accordion-item" >
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed text-light" type="button" data-bs-toggle="collapse" data-bs-target="#semestresCollapse{{ $curso->id }}" aria-expanded="false" aria-controls="semestresCollapse{{ $curso->id }}">
                                                {{ $curso->nombre }}
                                            </button>
                                        </h2>
                                        <div id="semestresCollapse{{ $curso->id }}" class="accordion-collapse collapse " data-bs-parent="#cursosAccordion" >
                                            <div class="accordion-body bg-white">
                                                <div class="accordion" id="semestresAccordion{{ $curso->id }}">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button collapsed text-dark text-end" type="button" data-bs-toggle="collapse" data-bs-target="#temasCollapse{{ $curso->id }}1" aria-expanded="false" aria-controls="temasCollapse{{ $curso->id }}1">
                                                                Semestre 1
                                                            </button>
                                                        </h2>
                                                        <div id="temasCollapse{{ $curso->id }}1" class="accordion-collapse collapse" data-bs-parent="#semestresAccordion{{ $curso->id }}">
                                                            <div class="accordion-body">
                                                                <div class="accordion" id="temasSemestreAccordion{{ $curso->id }}1">
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header">
                                                                            <button class="accordion-button collapsed text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#temaCollapse1" aria-expanded="false" aria-controls="temaCollapse1">
                                                                                Tema 1: Fundamentos de Programación
                                                                            </button>
                                                                        </h2>
                                                                        <div id="temaCollapse1" class="accordion-collapse collapse" data-bs-parent="#temasSemestreAccordion{{ $curso->id }}1">
                                                                            <div class="accordion-body">
                                                                                Contenido del tema 1
                                                                            </div>
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
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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

        <x-footers.auth></x-footers.auth>
    </main>
    <x-plugins></x-plugins>
</x-layout>


