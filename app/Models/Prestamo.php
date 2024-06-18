<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable=['fecha_de_prestamo','fecha_de_devolucion','devuelto','libro_id','usuario_id'];

    protected $table = 'prestamo';

    public function libro(){
        return $this->belongsTo(Libro::class,'libro_id');
    }

    public function usuario(){
        return $this->belongsTo(Usuario::class,'usuario_id');
    }
}
