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
            'titre' => 'required|string|max:255',
            'montant' => 'required|numeric|min:0',
            'categorie_id' => 'required|exists:categories,id',
            'colocation_user_id' => 'required|exists:colocation_user,id',
        ];
    }

    public function messages()
    {
        return [
            'titre.required' => 'Le titre de la dépense est requis.',
            'montant.required' => 'Le montant de la dépense est requis.',
            'categorie_id.required' => 'La catégorie de la dépense est requise.',
            'colocation_user_id.required' => 'L\'utilisateur de la dépense est requis.',
        ];
    }
}
