<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $fillable=['nombre','edad'];

    public $timestamps = false;

    protected $table = 'usuario';

    function prestamos(){
        return $this->hasMany(Prestamo::class);
    }
}
