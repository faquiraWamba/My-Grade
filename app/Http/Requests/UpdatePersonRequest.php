<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePersonRequest extends FormRequest
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
        return['first_name' => 'required',
            'last_name' => 'required',
            'gender'=>['required',Rule::in(['F','f','M','m'])],
            'phone' => ['numeric','digits:9'],
            // 'user_id' => ['required','exists:users,id','unique:people,user_id'],

        ];
    }
   

    public function messages()
    {
        return[
            'first_name.required'=>'un nom doit être fournit',
            'last_name.required'=>'un prénom doit être fournit',
            'gender.required'=>'le sexe doit être fournit',
            'gender.in'=>'le sexe ne peut etre que F ou M',
            'phone.numeric'=>'le numéro de téléphone doit être un donnée numérique',
            // 'user_id.required'=>'l\'identifient de l\'utilisateur doit être fournit',
            // 'user_id.exists'=>'l\'identifient de l\'utilisateur fournit doit exister dans la table user',
            // 'user_id.unique'=>'l\'identifient de l\'utilisateur entrez n\'est pas disponible',
        ];
    }
}
