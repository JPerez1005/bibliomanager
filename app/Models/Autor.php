<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable=['nombre'];
    
    protected $table = 'autor';

    function libros(){
        return $this->hasMany(Libro::class);
    }
}
