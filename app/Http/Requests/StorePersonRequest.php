<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePersonRequest extends FormRequest
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
            
     public function rules(FormRequest $request): array
     {

         $rules = [
             'first_name' => 'required',
             'last_name' => 'required',
             'gender' => ['required', Rule::in(['F','f','M','m'])]
         ];
     
         if (isset($request->phone)) {
             $rules['phone'] = ['unique:people,phone', 'digits:9'];
         }
     
         return $rules;
     }
     
   

    public function messages()
    {
        return[
            'first_name.required'=>'un nom doit être fournit',
            'last_name.required'=>'un prénom doit être fournit',
            'gender.required'=>'le sexe doit être fournit',
             'phone.unique'=>'ce numero de téléphone n\'est pas disponible',
        ];
    }
}
