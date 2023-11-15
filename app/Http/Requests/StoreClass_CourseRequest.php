<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClass_CourseRequest extends FormRequest
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
            
            'school_year'=> ['required','digits:4','integer','min:1900','max:'.(date('Y')+1)],
            'semester'=>['required',Rule::in([1,2])],
            'course_id'=>['required','exists:courses,id','integer'],
        ];
    }

    public function messages()
    {
        return[
            'semester.in'=>'le semestre ne peut qu\'être 1 ou 2',
            'semester.required'=>'le semestre doit être fournit',
            'school_year.required'=>'l\'année scolaire doit être fournit',
            'school_year.integer'=>'l\'année scolaire fournit etre une donnée numérique',
            'course_id.required'=>'l\'identifiant du cours doit être fournit',
            'course_id.exists'=>'l\'identifient du cours fournit doit exister dans la table cours',
            'course_id.integer'=>'l\'identifient du cours fournit etre une donnée numérique',
            ];
    }
}
