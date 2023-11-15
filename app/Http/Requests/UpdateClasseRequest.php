<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClasseRequest extends FormRequest
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
        return[
            'level'=>['required',Rule::in(['b1','b2','b3','m1','m2','B1','B2','B3','M1','M2'])],
            'description'=>['string'],
             'speciality_id'=>['required','exists:specialities,id','numeric']
         ];
     }
   
    
     public function messages()
     {
         return[
             'level.required'=>'veuillez fournit le nom du niveau',
             'level.in'=>'Les possibles noms de niveau sont "B1","B2","B3","M1" et "M2" ',
             'speciality_id.required'=>'veuillez fournit uen spécialité',
             'speciality_id.exists'=>'La spécialité fournit n\'existe pas',
             'speciality_id.numeric'=>'L\'identifiant de la spécialité doit être un nombre entier',
         ];
        }
}
