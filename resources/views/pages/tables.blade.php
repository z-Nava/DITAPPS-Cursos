<x-layout bodyClass="g-sidenav-show bg-gray-200">
  <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

      <!-- Navbar -->
      <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
      <!-- End Navbar -->
      <style>
        .custom-image {
  width: 200px; /* Ajusta el valor según el tamaño deseado */
  height: 150px; /* Ajusta el valor según el tamaño deseado */
  object-fit: cover; /* Para mantener la proporción de la imagen y recortar si es necesario */
}

      </style>
      <div class="container-fluid py-4 mt-5">
          <div class="row">
              <div class="col">
                  <div class="col-12">
                    @if(Auth::user()->rol_id != 4 && Auth::user()->rol_id != 3)
                      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarCursoModal">Agregar curso</button>
                      @endif
                      @if(Auth::user()->rol_id != 4 && Auth::user()->rol_id != 3)
                      <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarCursoModal">Eliminar curso</button> 
                      @endif
                  </div>
                  <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                      @foreach ($cursosNoInscritos as $curso)
                      <div class="col">
                          <div class="card my-4">
                              <div class="card-group">
                                  <div class="card" data-animation="false">
                                      <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 d-flex justify-content-center">
                                          <a class="d-block blur-shadow-image">
                                            <img src="{{ $curso->imagen_url }}" alt="Imagen del curso" class="custom-image">
                                          </a>
                                          <div class="colored-shadow" style="background-image: url(&quot;{{ asset($curso->imagen) }}&quot;);"></div>
                                      </div>
                                      <div class="card-body text-center">
                                          <div class="d-flex mt-n6 mx-auto">
                                              <a class="btn btn-link text-primary ms-auto border-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Refresh">
                                                  <i class="material-icons text-lg">refresh</i>
                                              </a>
                                              <button class="btn btn-link text-info me-auto border-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit">
                                                  <i class="material-icons text-lg">edit</i>
                                              </button>
                                          </div>
                                          <h5 class="font-weight-normal mt-3">
                                              <a href="javascript:;">{{ $curso->nombre }}</a>
                                          </h5>
                                          <p class="mb-0">
                                              {{ $curso->descripcion }}
                                          </p>
                                      </div>
                                      <hr class="dark horizontal my-0">
                                      <div class="card-footer d-flex justify-content-center">
                                       
                                        <a href="{{ route('curso.inscripcion', ['curso' => $curso->id]) }}" class="btn btn-primary btn-lg">Inscribirse al curso</a>
                                      
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
            @endforeach
          </div>
        </div>

        
        <x-footers.auth></x-footers.auth>
        <!-- Modal -->
        <div class="modal fade" id="agregarCursoModal" tabindex="-1" aria-labelledby="agregarCursoModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="agregarCursoModalLabel">Agregar curso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Formulario para agregar un nuevo curso -->
                <form action="{{ route('cursos.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                    <label for="titulo" class="form-label">Nombre del curso</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                  </div>
                  <div class="mb-3">
                    <label for="descripcion" class="form-label">Profesor del curso</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                  </div>
                  
                  <div class="mb-3">
                    <label for="descripcion" class="form-label">Semestre (opcional) </label>
                    <select class="form-control" id="semestre" name="semestre" required>
                      @foreach ($semestres as $semestre)
                        <option value="{{ $semestre->id }}">{{ $semestre->nombre }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="imagen">Imagen del curso:</label>
                    <input type="file" class="form-control" id="imagen" name="imagen">
                </div>
                  <div class="mb-3">
                    <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required min="{{ date('Y-m-d') }}">
                  </div>
                  <div class="mb-3">
                    <label for="fecha_fin" class="form-label">Fecha de fin</label>
                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required min="{{ date('Y-m-d') }}">
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal -->  
        <!-- Modal para eliminar curso -->
<div class="modal fade" id="eliminarCursoModal" tabindex="-1" aria-labelledby="eliminarCursoModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="eliminarCursoModalLabel">Eliminar curso</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('cursos.destroy', $curso->id ?? '') }}" method="POST">
          @csrf
          @method('DELETE')
          <div class="mb-3">
            <label for="cursoEliminar" class="form-label">Selecciona el curso a eliminar</label>
            <select class="form-select" id="cursoEliminar" name="cursoEliminar">
              @foreach ($cursosNoInscritos as $curso)
              <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
              @endforeach
            </select>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger">Eliminar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
      </div>
    </main>
    <x-plugins></x-plugins>
  </x-layout>