<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategorieRequest extends FormRequest
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
            'nom_categorie' => 'required|string|max:255|unique:categories,nom_categorie',
            'colocation_id' => 'required|exists:colocations,id',
        ];
    }
    public function messages()
    {
        return [
            'nom_categorie.required' => 'Le nom de la catégorie est requis.',
            'nom_categorie.unique' => 'Le nom de la catégorie doit être unique.',
            'colocation_id.required' => 'Veuillez fournir l\'ID de la colocation.',
            'colocation_id.exists' => 'La colocation spécifiée n\'existe pas.',
            
        ];
    }
}
