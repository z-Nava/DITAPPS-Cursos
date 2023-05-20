<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="col-md-12 mt-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0">Tus Temas</h6>
                        <a class="btn btn-primary" href="#" data-bs-toggle="modal" data-bs-target="#crearTemaModal">Agregar Tema</a>
                    </div>
                </div>
                <div class="card-body pt-4 p-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 text-sm">TEMA 1: FUNDAMENTOS DE PROGRAMACION</h6>
                                <span class="mb-2 text-xs">Profesor: <span
                                        class="text-dark font-weight-bold ms-sm-2">NAVARRETE VALLES JOSE ANGEL</span></span>
                                <span class="mb-2 text-xs">Descripción del tema: <span
                                        class="text-dark ms-sm-2 font-weight-bold">Se llevara acabo el repaso de los fundamentos de la programacion.</span></span>
                                
                            </div>
                            <div class="ms-auto text-end">
                                <a class="btn btn-link text-dark px-3 mb-2" href="javascript:;"><i
                                        class="material-icons text-sm me-2">edit</i>Editar</a>
                                <a class="btn btn-link text-dark px-3 mb-2" href="javascript:;"><i
                                        class="material-icons text-sm me-2">visibility</i>Ver</a>
                                <a class="btn btn-link text-dark px-3 mb-2" href="javascript:;"><i
                                        class="material-icons text-sm me-2">forum</i>Foro</a>
                                <a class="btn btn-link text-danger text-gradient px-3 mb-2"
                                        href="javascript:;"><i class="material-icons text-sm me-2">delete</i>Eliminar</a>
                            </div>
                        </li>
                        <!-- Resto de elementos de la lista -->
                    </ul>

                </div>
            </div>
        </div>
        <!-- Modal para crear un tema -->
        <div class="modal fade" id="crearTemaModal" tabindex="-1" aria-labelledby="crearTemaModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearTemaModalLabel">Crear Tema</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="temaTitulo" class="form-label">Título del Tema</label>
                                <input type="text" class="form-control" id="temaTitulo">
                            </div>
                            <div class="mb-3">
                                <label for="temaDescripcion" class="form-label">Descripción del Tema</label>
                                <textarea class="form-control" id="temaDescripcion" rows="3"></textarea>
                            </div>
                            <!-- Agrega más campos e información necesaria para el profesor -->
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
   
</x-layout>
