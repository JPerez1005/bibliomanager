<?php

namespace App\Http\Requests\Prestamo;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // 'fecha_de_prestamo'=>'required',
            'fecha_de_devolucion'=>'required|date|after:fecha_de_prestamo',
            'libro_id'=>'required|integer',
            'usuario_id'=>'required|integer',
        ];
    }
}
