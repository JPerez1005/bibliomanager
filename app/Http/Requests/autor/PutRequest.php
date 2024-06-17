<?php

namespace App\Http\Requests\autor;

use Illuminate\Foundation\Http\FormRequest;

class PutRequest extends FormRequest
{

    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'nombre'=>'required|min:5|max:500',
        ];
    }
}
