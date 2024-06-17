<?php

namespace App\Http\Requests\libro;

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
            'nombre'=>'required|min:5|max:500',
            'stock'=>'required|integer',
            'autor_id'=>'required|integer',
        ];
    }
}
