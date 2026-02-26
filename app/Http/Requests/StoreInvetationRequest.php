<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreInvetationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'colocation_id' => 'required|exists:colocations,id'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Veuillez fournir une adresse e-mail.',
            'email.email' => 'Veuillez fournir une adresse e-mail valide.',
            'email.max' => 'L\'adresse e-mail ne doit pas dépasser 255 caractères.',
            'colocation_id.required' => 'Veuillez fournir l\'ID de la colocation.',
            'colocation_id.exists' => 'La colocation spécifiée n\'existe pas.',

        ];
    }
}
