<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='dashboard'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Dashboard"></x-navbars.navs.auth>
        <!-- End Navbar -->
        @foreach($cursos as $curso)
            <h3>{{$curso->nombre}}</h3>
            <p>{{$curso->descripcion}}</p>
        @foreach ($curso->semestres as $semestre)
            <h4>Semestre: {{ $semestre->nombre }}</h4>
            <ul>
                @foreach ($semestre->temas as $tema)
                    <li>{{ $tema->nombre }}</li>
                    
                @endforeach
            </ul>
            @endforeach
        @endforeach
    </main>
</x-layout>

