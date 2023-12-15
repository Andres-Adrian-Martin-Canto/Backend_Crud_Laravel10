<?php

use App\Http\Controllers\Costo_Fijo_Controller;
use App\Http\Controllers\Costos_Variables_Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EstudioFinacieroController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\RegisterController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Crear cuenta:
Route::get('/crear-cuenta',[RegisterController::class, 'index'])->name('crear-cuenta');
Route::post('/crear-cuenta',[RegisterController::class, 'store']);

// Login:
Route::get('/',[LoginController::class, 'index'])->name('login');
Route::post('/',[LoginController::class, 'store']);

// Logout:
Route::post('/logout',[LogoutController::class,'store'])->name('logout');

// Agrupe las vistas que protegen que este autenticado
Route::middleware(['auth'])->group(function () {

    // Ruta para el Dashboard
    Route::get('/menu', [DashboardController::class, 'index'])->name('menu');

    // Rutas para el recurso Estudio Financiero
    Route::resource('estudio_financiero', EstudioFinacieroController::class);

    // Rutas para el recurso Costos Fijos
    Route::resource('costos_fijos', Costo_Fijo_Controller::class);

    // Rutas para el recurso Costos Variables.
    Route::resource('costos_variables', Costos_Variables_Controller::class);

});

