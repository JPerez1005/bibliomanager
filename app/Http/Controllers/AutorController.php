<?php

namespace App\Http\Controllers;

use App\Http\Requests\autor\PutRequest;
use App\Http\Requests\autor\StoreRequest;
use App\Models\Autor;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    public function all(){
        return response()->json(Autor::get());
    }

    public function index()
    {
        // Para las paginaciones
        return response()->json(Autor::paginate(10));
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Autor::create($request->validated()));
    }

    public function show(Autor $Autor)
    {
        return response()->json($Autor);
    }

    // Busqueda por nombre
    public function showBySlug(String $nombre)
    {
        $Autor=Autor::where('nombre',$nombre)->firstOrFail();
        return response()->json($Autor);
    }

    public function update(PutRequest $request, Autor $autor)
    {
        $autor->update($request->validated());
        return response()->json($autor);
    }

    public function destroy(Autor $autor)
    {
        $autor->delete();
        return response()->json('ok');
    }
}
