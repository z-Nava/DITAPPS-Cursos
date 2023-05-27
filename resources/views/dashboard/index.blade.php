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
                                    <!-- Muestra las tareas -->
                                    @if($recurso->tipo == 'tarea' && $recurso->estado == 'activo')
                                        <!-- Código existente para mostrar tareas -->
                                    @endif

                                    <!-- Muestra los exámenes -->
                                    @if($recurso->tipo == 'examen' && $recurso->estado == 'activo')
                                        <div class="card mt-3">
                                            <div class="card-header">
                                                <h5 class="mb-0">{{ $recurso->titulo }}</h5>
                                            </div>
                                            <div class="card-body">
                                                <p>Fecha de entrega: {{ $recurso->fecha_entrega }}</p>
                                                <!-- Aquí podrías mostrar las preguntas del examen, 
                                                    pero necesitarás cargarlas desde la base de datos -->
                                                <form action="{{ route('entregarExamen') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="recurso_id" value="{{ $recurso->id }}">
                                                    @foreach($recurso->preguntas as $pregunta)
                                                        <div class="mb-3">
                                                            <p>{{ $pregunta->pregunta }}</p>
                                                            @foreach($pregunta->respuestas as $respuesta)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="respuestas[{{ $pregunta->id }}]" value="{{ $respuesta->id }}" id="respuesta-{{ $respuesta->id }}">
                                                                    <label class="form-check-label" for="respuesta-{{ $respuesta->id }}">
                                                                        {{ $respuesta->respuesta }}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                    <button type="submit" class="btn btn-primary">Entregar examen</button>
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
