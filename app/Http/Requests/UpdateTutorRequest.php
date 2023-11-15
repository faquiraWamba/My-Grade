<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTutorRequest extends FormRequest
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
            'relation'=>['required',Rule::in(['tuteur','mère','père'])],
            'student_id' => ['exists:students,id'],

        ];
    }
  
    public function messages()
    {
        return[
            'relation.required'=>'la relation doit être fournit',
            'relation.in'=>'les relations possibles sont père, mère et tuteur',
            'student_id.exists'=>'l\'identifient de l\'étudiant fournit doit exister dans la table students',
        ];
    }
}
