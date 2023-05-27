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
                                        <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">Curso</th>
                                        <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7 ps-2">Tema</th>
                                        <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">Tarea/Examen</th>
                                        <th class="text-center text-uppercase text-secondary text-s font-weight-bolder opacity-7">Calificacion</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"></span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold"></span>
                                        </td>
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