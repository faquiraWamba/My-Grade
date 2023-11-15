<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTeacherRequest extends FormRequest
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
            'status'=>[Rule::in(['employé','ex employé'])],
            'person_id' => ['exists:people,id','unique:teachers,person_id'],

        ];
    }

    public function messages()
    {
        return[
            'status.in'=>'les status possibles employé et ex employé',
        ];
    }
}
