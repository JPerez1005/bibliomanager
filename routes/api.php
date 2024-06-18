<?php

use App\Http\Controllers\AutorController;
use App\Http\Controllers\LibroController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user',
function (Request $request) {
    return $request->user();
});

// Autor
Route::get('autor/all',[AutorController::class, 'all']);
Route::resource('autor',AutorController::class)->except(['create','edit']);

// Libro
Route::get('libro/all',[LibroController::class, 'all']);
Route::resource('libro',LibroController::class)->except(['create','edit']);