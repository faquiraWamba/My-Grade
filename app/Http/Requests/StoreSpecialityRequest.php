<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpecialityRequest extends FormRequest
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
            //register rules
            'acronym' => ['required','string','max:10','min:2','unique:specialities,acronym'],
            'description' => ['required','string','unique:specialities,description'],
        ];
    }

    public function messages()
    {
        return[
            'acronym.required'=>'un acronyme doit être fournit',
            'description.required'=>'une description doit être fournit',
            'acronym.max'=>'L\'acronyme d\'une spécialité doit avoir au maximun dix lettres',
            'acronym.min'=>'L\'acronyme d\'une spécialité doit avoir au minimum deux lettres',
            'acronym.unique'=>'une spécialité avec le même acronyme existe déja',
            'description.unique'=>'une spécialité avec la même description existe déja',
        
        ];
    }
}
