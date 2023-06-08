<x-layout bodyClass="">

    <div>
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
            <section>
                <div class="page-header min-vh-100">
                    <div class="container">
                        <div class="row">

                            <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-4 start-5 text-center justify-content-center flex-column">
                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner mb-4">
                              <div class="carousel-item active">
                                <div class="page-header min-vh-75 m-3 border-radius-xl" style="background-image:url('/assets/img/IDCC-ZAMORA/IDCC-ZAMORA-1.jpeg');  background-size: 100% 100%;">
                                  <div class="container">
                                    <div class="row justify-content-center">
                                      <div class="col-lg-6 my-auto">
                                        <!--<h4 class="text-white mb-0 fadeIn1 fadeInBottom">CURSO</h4>-->
                                       <!-- <h1 class="text-white fadeIn2 fadeInBottom">PROGRAMACION EN PHP</h1>-->
                                       <!-- <p class="lead text-white opacity-8 fadeIn3 fadeInBottom">APRENDERAS A USAR PHP, ADEMAS DE DIFERENTES FRAMEWORKS.</p> -->
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                               <div class="carousel-item">
                                <div class="page-header min-vh-75 m-3 border-radius-xl" style="background-image:url('/assets/img/IDCC-ZAMORA/IDCC-ZAMORA-2.jpeg');  background-size: 100% 100%;">
                                  <div class="container">
                                    <div class="row justify-content-center">
                                      <div class="col-lg-6 my-auto">
                                        <!--<h4 class="text-white mb-0 fadeIn1 fadeInBottom">CURSO</h4>-->
                                        <!--<h1 class="text-white fadeIn2 fadeInBottom">PROGRAMACION IoT CON PYTHON</h1>-->
                                        <!--<p class="lead text-white opacity-8 fadeIn3 fadeInBottom">APRENDERAS A USAR ARDUINO Y MANEJAR EL LENGUAJE PYTHON.</p>-->
                                      </div>
                                    </div>
                                  </div>
                                </div>  
                              </div>
                              <div class="carousel-item">
                                <div class="page-header min-vh-75 m-3 border-radius-xl" style="background-image:url('/assets/img/IDCC-ZAMORA/IDCC-ZAMORA-3.jpeg');  background-size: 100% 100%;">
                                  <div class="container">
                                    <div class="row justify-content-center">
                                      <div class="col-lg-6 my-auto">
                                        <!--<h4 class="text-white mb-0 fadeIn1 fadeInBottom">CURSO</h4>-->
                                        <!--<h1 class="text-white fadeIn2 fadeInBottom">FUNDAMENTO DE POO</h1>-->
                                        <!--<p class="lead text-white opacity-8 fadeIn3 fadeInBottom">APRENDERAS ACERCA DE LOS FUNDAMENTOS DE POO.</p>-->
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


                            <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
                                <div class="card card-plain">
                                    <div class="card-header">
                                        <h4 class="font-weight-bolder">Registro</h4>
                                        <p class="mb-0">Por favor, Ingresa tu nombre, numero de telefono, correo y contraseña</p>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf
                                            <div class="input-group input-group-outline mt-3">
                                                <label class="form-label">Nombre</label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ old('name') }}">
                                            </div>
                                            @error('name')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                            <div class="input-group input-group-outline mt-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ old('email') }}">
                                            </div>
                                            @error('email')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                            <div class="input-group input-group-outline mt-3">
                                                <label class="form-label">Numero de telefono</label>
                                                <input type="tel" class="form-control" name="phone"
                                                    value="{{ old('phone') }}">
                                            </div>
                                            @error('phone')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                            <div class="input-group input-group-outline mt-3">
                                                <label class="form-label">Contraseña</label>
                                                <input type="password" class="form-control" name="password">
                                            </div>
                                            @error('password')
                                            <p class='text-danger inputerror'>{{ $message }} </p>
                                            @enderror
                                            <div class="form-check form-check-info text-start ps-0 mt-3">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault" checked>
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Acepto los <a href="javascript:;"
                                                        class="text-dark font-weight-bolder">Terminos y condiciones</a>
                                                </label>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">Registrar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                        <p class="mb-2 text-sm mx-auto">
                                            Ya tienes una cuenta con nosotros?
                                            <a href="{{ route('login') }}"
                                                class="text-primary text-gradient font-weight-bold">Inicia Sesion</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

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

    function confirmacionRegistro() {
                console.log('entro al aviso');
                return confirm('Te has registrado correctamente!, por favor, verifica tu correo electronico y activa tu cuenta para poder iniciar sesion. Gracias!');
            }
    </script>
    @endpush
</x-layout>
