
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
                           <!-- <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#agregarCalificacionModal">Agregar Calificacion</button>-->
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <!-- MODAL AGREGAR CALIFICACION -->
<div class="modal fade" id="agregarCalificacionModal" tabindex="-1" role="dialog" aria-labelledby="agregarCalificacionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="agregarCalificacionModalLabel">Agregar Calificación</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="curso">Curso:</label>
                        <select class="form-control" id="curso" name="curso_id" required>
                            @foreach ($cursos as $curso)
                            <option value="{{ $curso['id'] }}">{{ $curso['nombre'] }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tema">Tema:</label>
                        <select class="form-control" id="tema" name="tema_id" required>
                            @foreach ($temas as $tema)
                                <option value="{{ $tema['nombre'] }}">{{ $tema['nombre'] }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="alumno">Alumno:</label>
                        <select class="form-control" id="alumno" name="alumno_id" required>
                            @foreach ($alumnos as $alumno)
                                <option value="{{ $alumno->id }}">{{ $alumno->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tarea">Tarea/Examen:</label>
                        <select class="form-control" id="tarea" name="recurso_id" required>
                            @foreach ($recursos as $recurso)
                                <option value="{{ $recurso->id }}">{{ $recurso->titulo }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="calificacion">Calificación:</label>
                        <input type="number" class="form-control" id="calificacion" name="calificacion" min="0" max="100" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Agregar Calificación</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIN MODAL AGREGAR CALIFICACION -->
                        <div class="table-responsive-sm p-0"> <!-- Agregar la clase table-responsive-sm -->
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">ID</th>
                                        <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">Curso</th>
                                        <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7 ps-2">Tema</th>
                                        <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">Tarea/Examen</th>
                                        <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">Alumno</th>
                                        <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">Calificacion</th>
                                        @if (Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2 || Auth::user()->rol_id == 3)
                                        <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7"> EDITAR </th>
                                        @endif                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($calificaciones as $calificacion)
                                        <tr>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $calificacion->id }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $calificacion->curso }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $calificacion->tema }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $calificacion->tarea }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $calificacion->alumno }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $calificacion->calificacion }}</span>
                                            </td>
                                            <td class="align-middle text-center">
                                                @if (Auth::user()->rol_id == 1 || Auth::user()->rol_id == 2 || Auth::user()->rol_id == 3)
                                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editarCalificacionModal{{ $calificacion->id }}">Editar</button>
                                                @endif
                                                <!-- MODAL EDITAR CALIFICACION -->
                                                <div class="modal fade" id="editarCalificacionModal{{ $calificacion->id }}" tabindex="-1" role="dialog" aria-labelledby="editarCalificacionModalLabel{{ $calificacion->id }}" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editarCalificacionModalLabel{{ $calificacion->id }}">Editar Calificación</h5>
                                                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('editarCalificacion', ['id' => $calificacion->id]) }}" method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="calificacion">Calificación:</label>
                                                                        <input type="number" class="form-control" id="calificacion" name="calificacion" min="0" max="100" required>
                                                                        <input type="hidden" name="entrega_id" value="{{ $calificacion->id }}">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                                    <button type="submit" class="btn btn-primary">Guardar Calificación</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- FIN MODAL EDITAR CALIFICACION -->
                                                
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
    </main>
    <x-plugins></x-plugins>
</x-layout>