<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['unique:courses,code'],
            'name' => ['required','unique:courses,name'],
            'credit' => ['required','integer']

        ];
    }
  

    public function messages()
    {
        return[
            'name.required'=>'le nom du cours doit être fournit',
            'credit.required'=>'le nombre de crédit du cours doit être fournit',
            'code.unique'=>'le code du cours fournit n\'est pas disponible',
            'name.unique'=>'le nom du cours fournit n\'est pas disponible',
            'credit.integer'=>'le nombre de credit doit être un entier'
        ];
    }
}
