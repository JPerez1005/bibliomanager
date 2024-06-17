<?php

namespace App\Http\Requests\libro;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'titulo'=>'required|min:5|max:500',
            'stock'=>'required|integer',
            'autor_id'=>'required|integer',
        ];
    }
}
