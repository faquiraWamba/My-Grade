<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNoteRequest extends FormRequest
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
        // dd('request request');

            $rules = [];
        $scores = $request->input('scores', []);
        foreach ($scores as $id => $note) {
            $rules["scores.$id"] = ['required', 'numeric', 'min:0', 'max:20'];
        }
        
        return $rules;
    }
    public function messages()
    {
        $messages = [];
        $scores = request()->input('scores', []);

        foreach ($scores as $id => $note) {
            $key = "scores.$id";
            $messages["{$key}.required"] = 'Entrez une note';
            $messages["{$key}.numeric"] = 'La note est est un réel positif';
            $messages["{$key}.min"] = 'La note doit être minimum 0';
            $messages["{$key}.max"] = 'La note doit être maximum 20';
        }

        return $messages;
    }
}
