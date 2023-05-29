<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="Gestion de actividades"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Gestion de actividades"></x-navbars.navs.auth>

        <div class="row">
          <div class="col-lg-6">
              <!-- Entregas de Tareas -->
              <div class="card h-100 mt-3">
                  <div class="card-header pb-0 p-3">
                      <div class="row">
                          <div class="col-6 d-flex align-items-center">
                              <h6 class="mb-0">Entregas de Tareas</h6>
                          </div>
                          <div class="col-6 text-end">
                          </div>
                      </div>
                  </div>
                  <div class="card-body p-3 pb-0">
                      <ul class="list-group">
                          @foreach ($entregas as $entrega)
                              @if ($entrega->calificacion === null && $entrega->recurso->tipo === 'tarea')
                                  <li id="entrega-{{ $entrega->id }}" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                      <div class="d-flex flex-column">
                                          <h4 class="">{{ $entrega->descripcion }}</h4>
                                          <h5 class="">Alumno: {{ $entrega->alumno->name }}</h5>
                                      </div>
                                      <div class="d-flex align-items-center text-sm">
                                          <a href="{{ asset($entrega->archivo) }}" class="btn btn-link text-dark text-sm mb-0 px-0 ms-4">
                                              <i class="material-icons text-lg position-relative me-1">picture_as_pdf</i> Descargar PDF
                                          </a>
                                          <button class="btn btn-primary btn-sm mb-0 ms-4" data-bs-toggle="modal" data-bs-target="#calificarModal{{ $entrega->id }}">Calificar</button>
                                          <!-- MODAL CALIFICAR TAREA -->
                                          <div class="modal fade" id="calificarModal{{ $entrega->id }}" tabindex="-1" role="dialog" aria-labelledby="calificarModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                      <div class="modal-header">
                                                          <h5 class="modal-title" id="calificarModalLabel">Calificar entrega</h5>
                                                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                          </button>
                                                      </div>
                                                      <form action="{{ route('gestion-actividades.calificar', $entrega->id) }}" method="POST">
                                                          @csrf
                                                          <div class="modal-body">
                                                              <div class="form-group">
                                                                  <label for="calificacion">Calificación</label>
                                                                  <input type="number" class="form-control" id="calificacion" name="calificacion" required min="0" max="100">
                                                              </div>
                                                          </div>
                                                          <div class="modal-footer">
                                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                              <button type="submit" class="btn btn-primary">Guardar calificación</button>
                                                          </div>
                                                      </form>
                                                  </div>
                                              </div>
                                          </div>
                                          <!-- ACABA MODAL CALIFICAR TAREA -->
                                      </div>
                                  </li>
                              @endif
                          @endforeach
                      </ul>
                  </div>
              </div>
          </div>
          <div class="col-lg-6">
              <!-- Entregas de Exámenes -->
              <div class="card h-100 mt-3">
                  <div class="card-header pb-0 p-3">
                      <div class="row">
                          <div class="col-6 d-flex align-items-center">
                              <h6 class="mb-0">Entregas de Exámenes</h6>
                          </div>
                          <div class="col-6 text-end">
                          </div>
                      </div>
                  </div>
                  <div class="card-body p-3 pb-0">
                      <ul class="list-group">
                          @foreach ($entregas as $entrega)
                              @if ($entrega->calificacion === null && $entrega->recurso->tipo === 'examen')
                                  <li id="entrega-{{ $entrega->id }}" class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                      <div class="d-flex flex-column">
                                          <h4 class="">{{ $entrega->descripcion }}</h4>
                                          <h5 class="">Alumno: {{ $entrega->alumno->name }}</h5>
                                      </div>
                                      <div class="d-flex align-items-center text-sm">
                                        <button class="btn btn-primary btn-sm mb-0 ms-4" data-bs-toggle="modal" data-bs-target="#calificarModal{{ $entrega->id }}" data-respuestas="{{ $entrega->respuestas }}">Calificar</button>
                                          <!-- MODAL CALIFICAR EXAMEN -->
<div class="modal fade" id="calificarModal{{ $entrega->id }}" tabindex="-1" role="dialog" aria-labelledby="calificarModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="calificarModalLabel">Calificar entrega</h5>
              <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <form action="{{ route('gestion-actividades.calificar', $entrega->id) }}" method="POST">
              @csrf
              <div class="modal-body">
                  <div class="form-group">
                      <label for="calificacion">Calificación</label>
                      <input type="number" class="form-control" id="calificacion" name="calificacion" required min="0" max="100">
                  </div>
                  <h4>Respuestas del alumno:</h4>
                  <ul>
                      @foreach ($entrega->respuestasUsuario as $respuestaUsuario)
                          <li>Pregunta: {{ $respuestaUsuario->pregunta->pregunta }}</li>
                          <li>Respuesta: {{ $respuestaUsuario->respuesta }}</li>
                      @endforeach
                  </ul>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <button type="submit" class="btn btn-primary">Guardar calificación</button>
              </div>
          </form>
      </div>
  </div>
</div>
<!-- ACABA MODAL CALIFICAR EXAMEN -->


                                      </div>
                                  </li>
                              @endif
                          @endforeach
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      
            
                
    </main>
    <x-plugins></x-plugins>
</x-layout> 