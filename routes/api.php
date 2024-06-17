<?php

use App\Http\Controllers\AutorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user',
function (Request $request) {
    return $request->user();
});

Route::post('autor', [AutorController::class, 'store']);
Route::get('autor/all',[AutorController::class, 'all']);
// Route::resource('autor',AutorController::class)->except(['create','edit']);