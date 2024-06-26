<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=['titulo','stock','autor_id'];

    protected $table = 'libro';

    public function autor(){
        return $this->belongsTo(Autor::class,'autor_id');
    }

    function prestamos(){
        return $this->hasMany(Prestamo::class);
    }

    public static function validationRules()
    {
        return [
            'titulo'=>'required|min:5|max:500',
            'stock'=>'required|integer',
            'autor_id'=>'required|integer',
        ];
    }
}
