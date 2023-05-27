<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="billing"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Billing"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="row">
            <div class="col-lg mt-4">
              <div class="card my-4">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                  <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                    <h6 class="text-white text-capitalize ps-3">Tus calificaciones</h6>
                  </div>
                </div>
                <div class="card-body px-0 pb-2">
                  <div class="table-responsive p-0">
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
                      <!-- ... -->
                        <tbody>
                            @foreach ($calificaciones as $calificacion)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $calificacion->curso }}</h6>
                                                <p class="text-xs text-secondary mb-0">{{ $calificacion->tema }}</p>
                                                <p class="text-xs text-secondary mb-0">{{ $calificacion->tarea }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-secondary text-xs font-weight-bold">{{ $calificacion->calificacion }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <!-- ... -->
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
