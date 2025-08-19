<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // return true cause this app don't have any authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nomPrenom' => ['required','string','max:255'], //nomPrenom n'est pas unique, car il peut y avoir des homonymes
            'email' => ['required', 'email','max:255', 'unique:eleves'],
            'telephone' => ['required', 'regex:/^\+?[0-9]{10,15}$/','min:10','max:15'],//min 10 = format national, max 15 = format international
            'dateInscription' => ['required', 'date'],
            'statutInscription' => ['required', 'in:en_attente,validee,dossier_incomplet,annulee'],
        ];
    }
}
