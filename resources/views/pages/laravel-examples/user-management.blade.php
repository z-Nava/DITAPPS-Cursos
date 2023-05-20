<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Gestion de Usuarios"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class=" me-6 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="javascript:;" data-bs-target="#agregarUsuarioModal" data-bs-toggle="modal"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Agregar nuevo usuario</a>
                        </div>
                        <!-- Modal Agregar usuario -->
            <div class="modal fade" id="agregarUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="agregarUsuarioModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-header">
                            <h5 class="modal-title" id="agregarUsuarioModalLabel">Agregar nuevo usuario</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('usermanagement.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="titulo" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" required placeholder="Ingresa el titulo del libro...">
                                </div>
                                <div class="mb-3">
                                    <label for="autor" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Ingresa el Autor del Libro" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="archivo" class="form-label">Rol</label>
                                    <select class="form-control-lg" name="rol_id" id="rol_id">
                                        <option value="1" id="rol_id" name="rol_id">SuperAdministrador</option>
                                        <option value="2" id="rol_id">Administrador</option>
                                        <option value="3" id="rol_id">Profesor</option>
                                        <option value="4" id="rol_id">Alumno</option>
                                    </select>
                                </div>
                                     
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                        <!-- AQUI ACABA MODAL SUBIR USUARIO -->                        
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID
                                            </th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NOMBRE</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                EMAIL</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                STATUS</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ROL</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                CREADO EL: 
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($usuarios as $user)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="mb-0 text-sm">{{$user->id}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <p class="mb-0 text-sm">{{$user->name}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{$user->email}}</h6>

                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs text-secondary mb-0">
                                                    {{$user->status}}</p>
                                                </p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{$user->rol_id}}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{$user->created_at}}</span>
                                            </td>
                                            <!--COPIAR LO DE ELIMNAR, TODO EL FORM-->
                                            <td class="align-middle">
                                                <a rel="tooltip" class="btn btn-success btn-link" data-bs-target="#editarUsuarioModal" data-bs-toggle="modal">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <form action="{{ route('usermanagement.destroy', ['id' => $user->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-link" onclick="return confirm('¿Estás seguro que deseas eliminar a este usuario?')">
                                                        <i class="material-icons">delete</i>
                                                        <div class="ripple-container"></div>
                                                    </button>
                                                </form>
                                            </td>                                        
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>

</x-layout>
