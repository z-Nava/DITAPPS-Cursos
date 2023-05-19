<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="rtl"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Biblioteca Digital"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="mb-1">
                                <form action="{{ route('libros.search') }}" method="GET">
                                        <label for="buscar" class="form-label">Buscar por título</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control-lg" id="buscar" name="buscar" placeholder="Ingresa el título del libro...">
                                            <button type="submit" class="btn btn-primary">Buscar</button>
                                        </div>
                                </form>
                                <!-- BUSCADOR POR LETRA -->
                                <label for="letra" class="form-label">Buscar por letra</label>
                                <form action="{{ route('libros.search') }}" method="GET">
                                    <select class="form-select-lg" id="letra" name="letra">
                                        <option value="">Seleccionar letra</option>
                                        <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                        <option value="e">E</option>
                                        <option value="f">F</option>
                                        <option value="g">G</option>
                                        <option value="h">H</option>
                                        <option value="i">I</option>
                                        <option value="j">J</option>
                                        <option value="k">K</option>
                                        <option value="l">L</option>
                                        <option value="m">M</option>
                                        <option value="n">N</option>
                                        <option value="ñ">Ñ</option>
                                        <option value="o">O</option>
                                        <option value="p">P</option>
                                        <option value="q">Q</option>
                                        <option value="r">R</option>
                                        <option value="s">S</option>
                                        <option value="t">T</option>
                                        <option value="u">U</option>
                                        <option value="v">V</option>
                                        <option value="w">W</option>
                                        <option value="x">X</option>
                                        <option value="y">Y</option>
                                        <option value="z">Z</option>

                                    <!-- Agrega las opciones para todas las letras del abecedario -->
                                    </select>
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </form>
                            </div>
                        </div>
                        <!-- AQUI PARA AGREGAR EL LIBRO -->
                        @if(auth()->user()->rol_id != 4)
                        <div class="me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="#" data-bs-toggle="modal" data-bs-target="#agregarLibroModal">
                                <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Agregar nuevo libro
                            </a>
                        </div>
                                              
                        @endif
                        <!-- Modal Agregar Libro -->
                        <div class="modal fade" id="agregarLibroModal" tabindex="-1" role="dialog" aria-labelledby="agregarLibroModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="agregarLibroModalLabel">Agregar nuevo libro</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('libros.store') }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="titulo" class="form-label">Título</label>
                                                <input type="text" class="form-control" id="titulo" name="titulo" required placeholder="Ingresa el titulo del libro...">
                                            </div>
                                            <div class="mb-3">
                                                <label for="autor" class="form-label">Autor</label>
                                                <input type="text" class="form-control" id="autor" name="autor" placeholder="Ingresa el Autor del Libro" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="descripcion" class="form-label">Descripción</label>
                                                <textarea class="form-control" id="descripcion" name="descripcion" rows="1" required placeholder="Ingresa una descripcion acerca del libro..."></textarea>
                                               
                                            </div>
                                            <div class="mb-3">
                                                <label for="archivo" class="form-label">Archivo</label>
                                                <input type="file" class="form-control" id="archivo" name="archivo" required>
                                            </div>
                                                 
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Subir libro</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                                    <!-- AQUI ACABA PARA SUBIR EL LIBRO -->
                        <!--EXPERIMENTOOOOO DE AQUI PARA ABAJO TODO BIEN...-->
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
                                                TITULO</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                AUTOR</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                DESCRIPCION</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ARCHIVO</th>
                                            
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($libros as $libro)
                                        @if(auth()->user()->rol_id != 4 || $libro->user_id == null)
                                            <tr>
                                                
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm">{{ $libro->id }}</p>
                                                        </div>
                                                    </div>
                                                </td>


                                               
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <h6 class="mb-0 text-sm">{{ $libro->titulo }}</h6>
                                                        </div>
                                                    </div>
                                                </td>

                                                
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <p class="text-xs text-secondary mb-0">{{ $libro->autor }}</p>
                                                    </div>
                                                </td>

                                                
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $libro->descripcion }}</p>
                                                </td>

                                                
                                                <td class="align-middle text-center">
                                                    @if($libro->archivo_extension === 'pdf')
                                                    <a href="{{ route('ver-archivo', ['id' => $libro->id]) }}" target="_blank">Ver archivo</a>
                                                    @else
                                                        <a href="{{ $libro->archivo_url }}" download>Descargar archivo</a>
                                                    @endif
                                                    <!-- Agrega un div o contenedor para la vista previa del archivo -->
                                                    <div id="vista-previa" style="display: none;">
                                                        <iframe id="iframe-archivo" src="" width="100%" height="500px"></iframe>
                                                    </div>

                                                    <script>
                                                    function verArchivo(url) {
                                                        var nuevaVentana = window.open(url, '_blank');
                                                        
                                                        // Esperar a que la ventana se cargue completamente antes de manipular el documento
                                                        nuevaVentana.onload = function() {
                                                            // Obtener el elemento del visor de PDF en la ventana abierta
                                                            var visorPDF = nuevaVentana.document.getElementById('pdf-viewer');
                                                            
                                                            if (visorPDF) {
                                                                // Deshabilitar la opción de impresión
                                                                var opcionImprimir = visorPDF.querySelector('[data-toolbar="print"]');
                                                                if (opcionImprimir) {
                                                                    opcionImprimir.style.display = 'none';
                                                                }
                                                                
                                                                // Deshabilitar la opción de descarga
                                                                var opcionDescargar = visorPDF.querySelector('[data-toolbar="download"]');
                                                                if (opcionDescargar) {
                                                                    opcionDescargar.style.display = 'none';
                                                                }
                                                            }
                                                        };
                                                    }
                                                    </script>
                                                </td>
                                                @if(auth()->user()->rol_id != 4)
                                                <td class="align-middle">
                                                    <form action="{{ route('eliminar-libro', ['id' => $libro->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-link" onclick="return confirm('¿Estás seguro de que deseas eliminar este documento?')">
                                                            <i class="material-icons">delete</i>
                                                            <div class="ripple-container"></div>
                                                        </button>
                                                    </form>
                                                </td>
                                                    @endif
                                            </tr>
                                                     @endif
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
