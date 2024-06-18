<?php

namespace App\Http\Controllers;

use App\Http\Requests\Prestamo\PutRequest;
use App\Http\Requests\Prestamo\StoreRequest;
use App\Models\Libro;
use App\Models\Prestamo;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    public function all(){
        return response()->json(Prestamo::get());
    }

    public function index()
    {
        // Para las paginaciones
        return response()->json(Prestamo::with(['libro','usuario'])->paginate(10));
    }

    public function update(PutRequest $request, Prestamo $Prestamo)
    {
        $data = $request->validated();

        if($Prestamo['devuelto']==true){
            throw new \Exception('El libro ya fué devuelto, si quiere otro prestamo registrelo');
        }

        $libro = Libro::find($Prestamo['libro_id']);
        if ($data['devuelto']==true) {
            $libro->increment('stock');
            $Prestamo->update($request->validated());
            return response()->json($Prestamo);
        }else{
            throw new \Exception('Acción incomprendida');
        }
    }

    public function store(StoreRequest $request)
    {
         // Sobrescribir el valor de 'fecha_de_prestamo' con la fecha actual
         $data = $request->validated();
         $data['fecha_de_prestamo'] = now()->toDateString();
 
         // Actualizar el stock del libro
         $libro = Libro::find($data['libro_id']);
         if ($libro) {
            if($libro['stock']>0){
                $libro->decrement('stock');
                // Crear el registro de préstamo
                $prestamo = Prestamo::create($data);
                return response()->json($prestamo);
            }else{
                throw new \Exception('El libro no está disponible para préstamo.');
            }
         }
    }

    public function show(Prestamo $Prestamo)
    {
        return response()->json($Prestamo);
    }

    // Busqueda por nombre
    public function showBySlug(String $nombre)
    {
        $Prestamo=Prestamo::where('nombre',$nombre)->firstOrFail();
        return response()->json($Prestamo);
    }

    

    public function destroy(Prestamo $Prestamo)
    {
        $Prestamo->delete();
        return response()->json('ok');
    }
}
