<?php

use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\GestiondeCursoController;
use App\Http\Controllers\GestionCursosAlumnoController;
use App\Http\Controllers\GestionActividadesController;

            
Route::get('/verify-email/{id}/{hash}', [RegisterController::class, 'verify'])->name('verification.verify');
Route::post('/libros', [LibroController::class, 'store'])->name('libros.store');


Route::get('/', function () {return redirect('sign-in');})->middleware('guest');



Route::get('/dashboard', [GestionCursosAlumnoController::class, 'index'])->middleware('auth')->name('dashboard');


Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');



Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', [GestiondeCursoController::class, 'getCalificaciones'])->name('billing');
	Route::put('billing/{id}', [GestiondeCursoController::class, 'editarCalificacion'])->name('editarCalificacion');






	Route::get('/tables', [CursoController::class, 'index'])->name('tables');
	Route::post('/tables', [CursoController::class, 'store'])->name('cursos.store');
	Route::delete('/tables/{id}', [CursoController::class, 'destroy'])->name('cursos.destroy');
	Route::get('/tables/{curso}', [CursoController::class, 'trabajo'])->name('curso.trabajo');



	Route::get('/rtl', [LibroController::class, 'show'])->name('rtl');
	Route::delete('/rtl/{id}', [LibroController::class, 'destroy'])->name('eliminar-libro');
	Route::get('/ver-archivo/{id}', [LibroController::class, 'verArchivo'])->name('ver-archivo');
	Route::get('/libros/search', [LibroController::class, 'search'])->name('libros.search');
	

	Route::get('/gestioncursos', [GestiondeCursoController::class, 'index'])->name('gestion-cursos');
	Route::post('/gestioncursos/semestre', [GestiondeCursoController::class, 'store'])->name('gestion-cursos.store');
	Route::post('/gestioncursos/tema', [GestiondeCursoController::class, 'storeTema'])->name('gestion-cursos.storeTema');
	Route::delete('/temas/{id}', [GestiondeCursoController::class, 'eliminarTema'])->name('gestion-cursos.eliminarTema');
	Route::get('/temas/{id}', [GestiondeCursoController::class, 'editarTema'])->name('gestion-cursos.editarTema');
	Route::post('/guardartarea', [GestiondeCursoController::class, 'storeTarea'])->name('guardarTarea');
	Route::post('/calificar/{id}', [GestiondeCursoController::class, 'calificarEntrega'])->name('gestion-cursos.calificarEntrega');
	
	Route::get('/gestion-cursos/crear-examen', [GestiondeCursoController::class, 'mostrarCrearExamen'])->name('gestion-cursos.mostrarCrearExamen');
	Route::post('/gestion-cursos/crear-examen', [GestiondeCursoController::class, 'crearExamen'])->name('gestion-cursos.crearExamen');



	Route::get('/curso/inscribir/{curso}', [GestionCursosAlumnoController::class, 'inscribirCurso'])->name('curso.inscripcion');
	
	Route::post('/entregartarea', [GestionCursosAlumnoController::class, 'entregarTarea'])->name('entregarTarea');
	

	Route::post('/entregarexamen', [GestionCursosAlumnoController::class, 'entregarExamen'])->name('entregarExamen');


	Route::get('/gestion-actividades', [GestionActividadesController::class, 'index'])->name('gestion-actividades');
	Route::post('/gestion-actividades/calificar/{id}', [GestionActividadesController::class, 'calificarEntrega'])->name('gestion-actividades.calificar');



	Route::get('virtual-reality', function () {return view('pages.virtual-reality');})->name('virtual-reality');
	Route::get('notifications', function () {return view('pages.notifications');})->name('notifications');
	Route::get('static-sign-in', function () {return view('pages.static-sign-in');})->name('static-sign-in');
	Route::get('static-sign-up', function () {return view('pages.static-sign-up');})->name('static-sign-up');
	Route::get('user-management', function () {return view('pages.laravel-examples.user-management');})->name('user-management');

	Route::get('user-management', [UserManagementController::class, 'index'])->name('user-management');
	#Route::get('/user-management', [UserManagementController::class, 'getEstudiantes'])->name('get-estudiantes');
	Route::post('user-management', [UserManagementController::class, 'store'])->name('usermanagement.store');
	Route::delete('user-management/{id}', [UserManagementController::class, 'destroy'])->name('usermanagement.destroy');
	Route::put('user-management/{id}', [UserManagementController::class, 'update'])->name('usermanagement.update');

	Route::get('user-profile', function () {return view('pages.laravel-examples.user-profile');})->name('user-profile');
});