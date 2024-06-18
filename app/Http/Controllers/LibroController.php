<?php

namespace App\Http\Controllers;

use App\Http\Requests\libro\PutRequest;
use App\Http\Requests\libro\StoreRequest;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{

    public function all(){
        return response()->json(Libro::get());
    }

    public function index()
    {
        // Para las paginaciones
        return response()->json(Libro::with('autor')->paginate(10));
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Libro::create($request->validated()));
    }

    public function show(Libro $Libro)
    {
        return response()->json($Libro);
    }

    // Busqueda por nombre
    public function showBySlug(String $nombre)
    {
        $Libro=Libro::where('nombre',$nombre)->firstOrFail();
        return response()->json($Libro);
    }

    public function update(PutRequest $request, Libro $Libro)
    {
        $Libro->update($request->validated());
        return response()->json($Libro);
    }

    public function destroy(Libro $Libro)
    {
        $Libro->delete();
        return response()->json('ok');
    }
}
