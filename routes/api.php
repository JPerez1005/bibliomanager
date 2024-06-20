<?php

// use App\Http\Controllers\AutorController;
// use App\Http\Controllers\LibroController;
// use App\Http\Controllers\PrestamoController;
// use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\MultiModelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user',
function (Request $request) {
    return $request->user();
});



Route::prefix('{type}')->group(function () {
    Route::get('/all', [MultiModelController::class, 'all']);
    Route::get('/paginate', [MultiModelController::class, 'index']);
    Route::post('/', [MultiModelController::class, 'store']);
    Route::get('/{id}', [MultiModelController::class, 'show']);
    Route::put('/{id}', [MultiModelController::class, 'update']);
    Route::delete('/{id}', [MultiModelController::class, 'destroy']);
});

// // Autor
// Route::get('autor/all',[AutorController::class, 'all']);
// Route::resource('autor',AutorController::class)->except(['create','edit']);

// // Libro
// Route::get('libro/all',[LibroController::class, 'all']);
// Route::resource('libro',LibroController::class)->except(['create','edit']);

// // Usuario
// Route::get('usuario/all',[UsuarioController::class, 'all']);
// Route::resource('usuario',UsuarioController::class)->except(['create','edit']);

// // Prestamo
// Route::get('prestamo/all',[PrestamoController::class, 'all']);
// Route::resource('prestamo',PrestamoController::class)->except(['create','edit']);
