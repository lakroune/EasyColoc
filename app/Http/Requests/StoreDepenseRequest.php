<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\Mime\Message;

class StoreDepenseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titre' => 'required|string|max:50',
            'montant' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'colocation_id' => 'required|exists:colocations,id',
        ];
    }

    public function messages()
    {
        return [
            'titre.required' => 'Le titre de la dépense est requis.',
            'titre.max' => 'Le titre de la dépense ne doit pas dépasser 50 caractères.',
            'montant.required' => 'Le montant de la dépense est requis.',
            'categorie_id.required' => 'La catégorie de la dépense est requise.',
            'categorie_id.exists' => 'La catégorie spécifiée n\'existe pas.',
            'colocation_id.required' => 'Veuillez fournir l\'ID de la colocation.',
            'colocation_id.exists' => 'La colocation spécifiée n\'existe pas.',
        ];
    }
}
