<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'birthday' => ['required','date'],
            // 'person_id' => ['required','exists:people,id','unique:students,person_id','numeric'],
            'school_year'=> ['required','digits:4','integer','min:1900','max:'.(date('Y')+1)],
            'birth_town'=>['required','string'],
            'picture'=>['image'],
            'classe_id'=>['required','exists:classes,id','integer'],
            
        ];
    }

    public function messages()
    {
        return[
            // 'registration_number.required'=>'un matricule doit être fournit',
            'birthday.required'=>'une date de naissance doit être fournit',
            // 'person_id.required'=>'l\'identifiant de la personne doit être fournit',
            'classe_id.required'=>'l\'identifiant de la salle de classe doit être fournit',
            // 'report_card.required'=>'le lien vers le bulletin de notes doit être fournit',
            'school_year.required'=>'l\'année scolaire doit être fournit',
            'school_year.year'=>'l\'année scolaire doit être de type année',
            'birthday.date'=>'la date de naissance doit être de type date',
            'classe_id.exists'=>'l\'identifient de la salle de classe fournit doit exister dans la table classes',
            'classe_id.integer'=>'l\'identifient de la salle de classe fournit etre une donnée numérique',
            'school_year.integer'=>'l\'année scolaire fournit etre une donnée numérique',
            // 'person_id.exists'=>'l\'identifient de la personne fournit doit exister dans la table user',
            // 'person_id.unique'=>'l\'identifient de la personne entrez n\'est pas disponible',
        ];
    }
}
