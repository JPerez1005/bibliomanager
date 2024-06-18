<?php

namespace App\Http\Requests\Prestamo;

use Illuminate\Foundation\Http\FormRequest;

class PutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'devuelto'=>'required',
            // 'fecha_de_prestamo'=>'required',
            // 'fecha_de_devolucion'=>'required',
            // 'libro_id'=>'required|integer',
            // 'usuario_id'=>'required|integer',
        ];
    }
}
