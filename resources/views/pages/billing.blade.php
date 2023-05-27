<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="billing"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Billing"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="row">
            <div class="col-lg mt-4 " >
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Tus calificaciones</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive-sm p-0"> <!-- Agregar la clase table-responsive-sm -->
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Curso</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tema</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tarea/Examen</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Calificacion</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($calificaciones as $calificacion)
                                    <tr>
                                        <td>{{ $calificacion->curso }}</td>
                                        <td>{{ $calificacion->tema }}</td>
                                        <td>{{ $calificacion->tarea }}</td>
                                        <td class="text-end">{{ $calificacion->calificacion }}</td>
                                        <td class="align-middle">
                                            @if(in_array(Auth::user()->rol_id, [1, 2, 3])) 
                                            <button class="btn btn-link text-secondary mb-0" data-bs-toggle="modal" data-bs-target="#modalEditarCalificacion{{ $calificacion->id }}">
                                                Editar
                                            </button>                             
                                            @endif
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

        @foreach ($calificaciones as $calificacion)
    <!-- Modal de Edición -->
    <div class="modal fade" id="modalEditarCalificacion{{ $calificacion->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditarCalificacionLabel{{ $calificacion->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Contenido del modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editarModalLabel{{ $calificacion->id }}">Editar Calificación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('editarCalificacion', $calificacion->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="calificacion{{ $calificacion->id }}">Calificación:</label>
                            <input type="text" class="form-control" id="calificacion{{ $calificacion->id }}" name="calificacion" value="{{ $calificacion->calificacion }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@endforeach


    </main>
    <x-plugins></x-plugins>

</x-layout>