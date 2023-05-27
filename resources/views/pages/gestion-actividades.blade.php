<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="Gestion de actividades"></x-navbars.sidebar>
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
                                <h6 class="mb-0">Entregas de actividades</h6>
                            </div>
                            <div class="col-6 text-end">
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3 pb-0">
                        <ul class="list-group">
                            @foreach ($entregas as $entrega)
                                <li id="entrega-{{ $entrega->id }}" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark font-weight-bold text-sm">{{ $entrega->id }}</h6>
                                        <span class="text-xs">{{ $entrega->descripcion }}</span>
                                        <span class="text-xs">Alumno: {{ $entrega->user_id }}</span>
                                    </div>
                                    <div class="d-flex align-items-center text-sm">
                                        <a href="{{ asset($entrega->archivo) }}" class="btn btn-link text-dark text-sm mb-0 px-0 ms-4">
                                            <i class="material-icons text-lg position-relative me-1">picture_as_pdf</i> Descargar PDF
                                        </a>
                                        <button class="btn btn-primary btn-sm mb-0 ms-4" data-bs-toggle="modal" data-bs-target="#calificarModal">Calificar</button>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <!-- Segundo div -->
                <div class="col-lg mt-3">
                    <div class="card h-100">
                        <div class="card-header pb-0 px-3">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h6 class="mb-0">Actividades encargadas</h6>
                                    <button class="btn btn-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#crearActividadModal">Crear Tarea</button>
                                    <button class="btn btn-primary btn-sm mb-0">Crear examen</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-4 p-3">
                            <ul class="list-group">
                                <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <h5 class="mb-1 text-dark text-sm"></h5>
                                            <h6 class="mb-1 text-dark text-sm"></h6>
                                            <span class="text-xs"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold">
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>   
    </main>
    <x-plugins></x-plugins>
</x-layout> 