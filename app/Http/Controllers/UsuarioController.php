<?php

namespace App\Http\Controllers;

use App\Http\Requests\Usuario\PutRequest;
use App\Http\Requests\Usuario\StoreRequest;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function all(){
        return response()->json(Usuario::get());
    }

    public function index()
    {
        // Para las paginaciones
        return response()->json(Usuario::paginate(10));
    }

    public function store(StoreRequest $request)
    {
        return response()->json(Usuario::create($request->validated()));
    }

    public function show(Usuario $Usuario)
    {
        return response()->json($Usuario);
    }

    // Busqueda por nombre
    public function showBySlug(String $nombre)
    {
        $Usuario=Usuario::where('nombre',$nombre)->firstOrFail();
        return response()->json($Usuario);
    }

    public function update(PutRequest $request, Usuario $Usuario)
    {
        $Usuario->update($request->validated());
        return response()->json($Usuario);
    }

    public function destroy(Usuario $Usuario)
    {
        $Usuario->delete();
        return response()->json('ok');
    }
}
