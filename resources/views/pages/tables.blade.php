<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="tables"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
      <!-- Navbar -->
      <x-navbars.navs.auth titlePage="Tables"></x-navbars.navs.auth>
      <!-- End Navbar -->
      <div class="container-fluid py-4 mt-5">
        <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-group">
                <div class="card" data-animation="true">
                  <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <a class="d-block blur-shadow-image">
                      <img src="https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                    </a>
                    <div class="colored-shadow" style="background-image: url(&quot;https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg&quot;);"></div>
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
                      <a href="javascript:;">FUNDAMENTOS DE C#</a>
                    </h5>
                    <p class="mb-0">
                      En este curso se hablara de los fundamentos de C#.
                    </p>
                  </div>
                  <hr class="dark horizontal my-0">
                  <div class="card-footer d-flex justify-content-center">
                    <button class="btn btn-primary btn-lg">Inscribirse a curso</button>
                  </div>
                </div>
                <div class="card" data-animation="true">
                  <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <a class="d-block blur-shadow-image">
                      <img src="https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                    </a>
                    <div class="colored-shadow" style="background-image: url(&quot;https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg&quot;);"></div>
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
                      <a href="javascript:;">CURSO DE POO</a>
                    </h5>
                    <p class="mb-0">
                      EN ESTE CURSO SE HABLARA DE LA PROGRAMACION ORIENTADA A OBJETOS.
                    </p>
                  </div>
                  <hr class="dark horizontal my-0">
                  <div class="card-footer d-flex justify-content-center">
                    <button class="btn btn-primary btn-lg">Inscribirse a curso</button>
                  </div>
                </div>
                <div class="card" data-animation="true">
                  <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <a class="d-block blur-shadow-image">
                      <img src="https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-lg">
                    </a>
                    <div class="colored-shadow" style="background-image: url(&quot;https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg&quot;);"></div>
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
                      <a href="javascript:;">CURSO DE PYTHON</a>
                    </h5>
                    <p class="mb-0">
                      EN ESTE CURSO SE HABLARA DE LA PROGRAMACION EN PYTHON.
                    </p>
                  </div>
                  <hr class="dark horizontal my-0">
                  <div class="card-footer d-flex justify-content-center">
                    <button class="btn btn-primary btn-lg">Inscribirse a curso</button>
                  </div>
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