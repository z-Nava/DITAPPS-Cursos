<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container mt-4">
            @foreach($cursos as $curso)
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="mb-0">{{ $curso->nombre }}</h3>
                    </div>
                    <div class="card-body">
                        <p>{{ $curso->descripcion }}</p>
                        @foreach ($curso->semestres as $semestre)
                            <h4>Semestre: {{ $semestre->nombre }}</h4>
                            <ul>
                                @foreach ($semestre->temas as $tema)
                                    <li>{{ $tema->nombre }}</li>
                                    @foreach($tema->recursos as $recurso)
                                       
                                        @if($recurso->tipo == 'tarea' && $recurso->estado == 'activo')
                                        <div class="card mt-3">
                                            <div class="card-header">
                                                <h5 class="mb-0">{{ $recurso->titulo }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <p>{{ $recurso->contenido }}</p>
                                                <p>Fecha de entrega: {{ $recurso->fecha_entrega }}</p>
                                    
                                                <form action="{{ route('entregarTarea') }}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="recurso_id" value="{{ $recurso->id }}">
                                                    <div class="mb-3">
                                                        <label for="descripcion" class="form-label">Descripción</label>
                                                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="archivo" class="form-label">Subir Archivo</label>
                                                        <input class="form-control" type="file" id="archivo" name="archivo">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Entregar tarea</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @endforeach
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        
    </main>
</x-layout>
