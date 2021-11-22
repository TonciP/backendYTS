<?php

use App\Http\Controllers\CalidadController;
use App\Http\Controllers\PeliculaController;
use App\Http\Controllers\PeliculaRelacionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/pelicula',[PeliculaController::class, 'index'])->name('ver pelicula');
Route::get('/pelicula/{id}',[PeliculaController::class, 'show'])->name('ver una pelicula');
Route::post('/pelicula',[PeliculaController::class, 'store'])->name('guardar pelicula');
Route::delete('/pelicula/{id}',[PeliculaController::class, 'destroy'])->name('eliminar pelicula');
Route::put('/pelicula/{id}',[PeliculaController::class, 'update'])->name('actualizar pelicula');
Route::post('/pelicula/subirImagen/{id}',[PeliculaController::class, 'subirImagenPelicula'])->name('Subir Imagen');

Route::get('/pelicula_relacion',[PeliculaRelacionController::class, 'index'])->name('ver pelicula');
Route::get('/pelicula_relacion/{id}',[PeliculaRelacionController::class, 'show'])->name('ver una pelicula');
//Route::get('/pelicula_relacion/pertenece/{id}',[PeliculaRelacionController::class, 'ByIdPeliculaPertenece'])->name('ver una pelicula que pertenece');
Route::post('/pelicula_relacion',[PeliculaRelacionController::class, 'store'])->name('guardar pelicula');
Route::delete('/pelicula_relacion/{id}',[PeliculaRelacionController::class, 'destroy'])->name('eliminar pelicula');
Route::put('/pelicula_relacion',[PeliculaRelacionController::class, 'update'])->name('actualizar pelicula');

Route::get('/calidad',[CalidadController::class, 'index'])->name('ver pelicula');
Route::get('/calidad/pelicula',[CalidadController::class, 'peliculaCalidad'])->name('ver pelicula calidad');
Route::get('/calidad/{id}',[CalidadController::class, 'show'])->name('ver una pelicula');
Route::post('/calidad',[CalidadController::class, 'store'])->name('guardar pelicula');
Route::delete('/calidad/{id}',[CalidadController::class, 'destroy'])->name('eliminar pelicula');
Route::put('/calidad/{id}',[CalidadController::class, 'update'])->name('actualizar pelicula');
