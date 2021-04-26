<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|string|max:255',
                'cognome' => 'required|string|max:255',
                'indirizzo' => 'required|string|max:255',
                'citta' => 'required|string|max:255',
                'cap' => 'required|numeric',
                'provincia' => 'required|string|max:4',
                'telefono' => 'required|string|max:20',
                'mail' => 'required|email',
                'tipo' => 'required',
                'fonte' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Il nome è obbligatorio',
            'cognome.required' => 'Il cognome è obbligatorio',
            'indirizzo.required' => "l'indirizzo è obbligatorio",
            'citta.required' => 'la città è obbligatoria',
            'cap.required' => 'il cap è obbligatorio',
            'provincia.required' => 'PR obbligatoria',
            'telefono.required' => 'il telefono è obbligatorio',
            'mail.required' => 'la mail è obbligatoria',
            'tipo.required' => 'il tipo è obbligatorio',
            'fonte.required' => 'la fonte è obbligatoria',
        ];
    }
}
