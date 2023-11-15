<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourse_teacherRequest extends FormRequest
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
            
            'course_id'=>['required','exists:courses,id','integer'],
        ];
        }
    
        public function messages()
        {
            return[
                'course_id.required'=>'l\'identifiant du cours doit être fournit',
                'course_id.exists'=>'l\'identifient du cours fournit doit exister dans la table cours',
                'course_id.integer'=>'l\'identifient du cours fournit etre une donnée numérique',
                ];
        }
}
