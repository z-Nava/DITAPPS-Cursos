<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <x-navbars.sidebar activePage="billing"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Billing"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="card">
            <div class="table-responsive">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Curso</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Calificación</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Estado</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Avance</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      <div class="d-flex px-2">
                        <div>
                          <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-spotify.svg" class="avatar avatar-sm rounded-circle me-2">
                        </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-xs">FUNDAMENTOS DE PHP</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-normal mb-0">8/10</p>
                    </td>
                    <td>
                      <span class="badge badge-dot me-4">
                        <i class="bg-info"></i>
                        <span class="text-dark text-xs">Trabajando</span>
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="d-flex align-items-center">
                        <span class="me-2 text-xs">60%</span>
                        <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                      </div>
                    </td>
          
                    <td class="align-middle">
                      <button class="btn btn-link text-secondary mb-0">
                        <span class="material-icons">
                          more_vert
                        </span>
                      </button>
                    </td>
                  </tr> 
          
                  <tr>
                    <td>
                      <div class="d-flex px-2">
                        <div>
                          <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-invision.svg" class="avatar avatar-sm rounded-circle me-2">
                        </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-xs">FUNDAMENTOS DE PHP</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-normal mb-0">10/10</p>
                    </td>
                    <td>
                      <span class="badge badge-dot me-4">
                        <i class="bg-success"></i>
                        <span class="text-dark text-xs">done</span>
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="d-flex align-items-center">
                        <span class="me-2 text-xs">100%</span>
                        <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                      </div>
                    </td>
          
                    <td class="align-middle">
                      <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                        <span class="material-icons">
                        more_vert
                        </span>
                      </button>
                    </td>
                  </tr>
          
                  <tr>
                    <td>
                      <div class="d-flex px-2">
                        <div>
                          <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-jira.svg" class="avatar avatar-sm rounded-circle me-2">
                        </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-xs">CURSO DE C#</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-normal mb-0">0/10</p>
                    </td>
                    <td>
                      <span class="badge badge-dot me-4">
                        <i class="bg-danger"></i>
                        <span class="text-dark text-xs">canceled</span>
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="d-flex align-items-center">
                        <span class="me-2 text-xs">30%</span>
                        <div class="progress-bar bg-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>

                      </div>
                    </td>
          
                    <td class="align-middle">
                      <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                        <span class="material-icons">
                        more_vert
                        </span>
                      </button>
                    </td>
                  </tr>
          
                  <tr>
                    <td>
                      <div class="d-flex px-2">
                        <div>
                          <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-slack.svg" class="avatar avatar-sm rounded-circle me-2">
                        </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-xs">CURSO DE HTML 5</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-normal mb-0">0/10</p>
                    </td>
                    <td>
                      <span class="badge badge-dot me-4">
                        <i class="bg-danger"></i>
                        <span class="text-dark text-xs">canceled</span>
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="d-flex align-items-center">
                        <span class="me-2 text-xs">0%</span>
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>

                      </div>
                    </td>
          
                    <td class="align-middle">
                      <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                        <span class="material-icons">
                        more_vert
                        </span>
                      </button>
                    </td>
                  </tr>
          
                  <tr>
                    <td>
                      <div class="d-flex px-2">
                        <div>
                          <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-webdev.svg" class="avatar avatar-sm rounded-circle me-2">
                        </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-xs">CURSO DE JAVASCRIPT</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-normal mb-0">8/10</p>
                    </td>
                    <td>
                      <span class="badge badge-dot me-4">
                        <i class="bg-info"></i>
                        <span class="text-dark text-xs">working</span>
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="d-flex align-items-center">
                        <span class="me-2 text-xs">80%</span>
                        <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>

                      </div>
                    </td>
          
                    <td class="align-middle">
                      <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                        <span class="material-icons">
                        more_vert
                        </span>
                      </button>
                    </td>
                  </tr>
          
                  <tr>
                    <td>
                      <div class="d-flex px-2">
                        <div>
                          <img src="https://demos.creative-tim.com/soft-ui-design-system-pro/assets/img/logos/small-logos/logo-xd.svg" class="avatar avatar-sm rounded-circle me-2">
                        </div>
                        <div class="my-auto">
                          <h6 class="mb-0 text-xs">CURSO DE PYTHON BASADO EN IOT</h6>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-normal mb-0">10/10</p>
                    </td>
                    <td>
                      <span class="badge badge-dot me-4">
                        <i class="bg-success"></i>
                        <span class="text-dark text-xs">done</span>
                      </span>
                    </td>
                    <td class="align-middle text-center">
                      <div class="d-flex align-items-center">
                        <span class="me-2 text-xs">100%</span>
                        <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>

                      </div>
                    </td>
          
                    <td class="align-middle">
                      <button class="btn btn-link text-secondary mb-0" aria-haspopup="true" aria-expanded="false">
                        <span class="material-icons">
                        more_vert
                        </span>
                      </button>
                    </td>
                  </tr>
          
                </tbody>
              </table>
            </div>
        </div>
            <x-footers.auth></x-footers.auth>
    </main>
    <x-plugins></x-plugins>

</x-layout>
