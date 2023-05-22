<x-layout bodyClass="bg-gray-200">

        <div class="container position-sticky z-index-sticky top-0">
            <div class="row">
                <div class="col-12">
                    <!-- Navbar -->
                    <x-navbars.navs.guest signin='login' signup='register'></x-navbars.navs.guest>
                    <!-- End Navbar -->
                </div>
            </div>
        </div>
        <main class="main-content  mt-0">
            <div class="page-header align-items-start min-vh-100"
                style="background-image: url('https://images.unsplash.com/photo-1497294815431-9365093b7331?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1950&q=80');">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <div class="container my-auto">
                    
                    <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-4 start-5 text-center justify-content-center flex-column">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner mb-4">
                              <div class="carousel-item">
                                <div class="page-header min-vh-75 m-3 border-radius-xl" style="background-image: url('https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-3-min.jpg');">
                                  <span class="mask bg-gradient-dark"></span>
                                  <div class="container">
                                    <div class="row justify-content-center">
                                      <div class="col-lg-6 my-auto">
                                        <h4 class="text-white mb-0 fadeIn1 fadeInBottom">CURSO</h4>
                                        <h1 class="text-white fadeIn2 fadeInBottom">PROGRAMACION EN PHP</h1>
                                        <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">APRENDERAS A USAR PHP, ADEMAS DE DIFERENTES FRAMEWORKS.</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                               <div class="carousel-item">
                                <div class="page-header min-vh-75 m-3 border-radius-xl" style="background-image: url('https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-1-min.jpg');">
                                  <span class="mask bg-gradient-dark"></span>
                                  <div class="container">
                                    <div class="row justify-content-center">
                                      <div class="col-lg-6 my-auto">
                                        <h4 class="text-white mb-0 fadeIn1 fadeInBottom">CURSO</h4>
                                        <h1 class="text-white fadeIn2 fadeInBottom">PROGRAMACION IoT CON PYTHON</h1>
                                        <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">APRENDERAS A USAR ARDUINO Y MANEJAR EL LENGUAJE PYTHON.</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>  
                              </div>
                              <div class="carousel-item active">
                                <div class="page-header min-vh-75 m-3 border-radius-xl" style="background-image: url('https://demos.creative-tim.com/test/material-dashboard-pro/assets/img/products/product-2-min.jpg');">
                                  <span class="mask bg-gradient-dark"></span>
                                  <div class="container">
                                    <div class="row justify-content-center">
                                      <div class="col-lg-6 my-auto">
                                        <h4 class="text-white mb-0 fadeIn1 fadeInBottom">CURSO</h4>
                                        <h1 class="text-white fadeIn2 fadeInBottom">FUNDAMENTO DE POO</h1>
                                        <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">APRENDERAS ACERCA DE LOS FUNDAMENTOS DE POO.</p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="min-vh-75 position-absolute w-100 top-0">
                              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon position-absolute bottom-50" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                              </a>
                              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                                <span class="carousel-control-next-icon position-absolute bottom-50" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                              </a>
                            </div>
                          </div>
                    </div>

                    <div class="row signin-margin">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                            <div class="card z-index-0 fadeIn3 fadeInBottom">
                                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Iniciar Sesion</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form role="form" method="POST" action="{{ route('login') }}" class="text-start">
                                        @csrf
                                        @if (Session::has('status'))
                                        <div class="alert alert-success alert-dismissible text-white" role="alert">
                                            <span class="text-sm">{{ Session::get('status') }}</span>
                                            <button type="button" class="btn-close text-lg py-3 opacity-10"
                                                data-bs-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="">
                                        </div>
                                        @error('email')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                        <div class="input-group input-group-outline mt-3">
                                            <label class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" name="password" value=''>
                                        </div>
                                        @error('password')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                        <div class="form-check form-switch d-flex align-items-center my-3">
                                            <input class="form-check-input" type="checkbox" id="rememberMe">
                                            <label class="form-check-label mb-0 ms-2" for="rememberMe">Recuerdame</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Iniciar Sesion</button>
                                        </div>
                                        @if (session('status'))
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            
                                            @endif
                                        <p class="mt-4 text-sm text-center">
                                            Aun no tienes una cuenta?
                                            <a href="{{ route('register') }}"
                                                class="text-primary text-gradient font-weight-bold">Registrate!</a>
                                        </p>
                                        <p class="text-sm text-center">
                                            Olvidaste tu contraseña?
                                            <a href="{{ route('verify') }}"
                                                class="text-primary text-gradient font-weight-bold">Entra aqui!</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <x-footers.guest></x-footers.guest>
            </div>
        </main>
        @push('js')
<script src="{{ asset('assets') }}/js/jquery.min.js"></script>
<script>
    $(function() {

    var text_val = $(".input-group input").val();
    if (text_val === "") {
      $(".input-group").removeClass('is-filled');
    } else {
      $(".input-group").addClass('is-filled');
    }
});
</script>
@endpush
</x-layout>
