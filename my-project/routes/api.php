<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\costos_fijosApi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Usamos el controlador normal y funciono pero no de la forma json.
// Route::post('add-costo-fijo',[Costo_Fijo_Controller::class,'store']);

Route::apiResource('costos-fijos', costos_fijosApi::class);
