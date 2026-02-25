<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreColocationRequest extends FormRequest
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
            'nom_coloc' => 'required|string|max:100|unique:colocations,nom_coloc',
        ];
    }
    public function messages()
    {
        return [
            'nom_coloc.required' => 'Le nom de la colocation est requis.',
            'nom_coloc.unique' => 'Le nom de la colocation doit être unique.',
        ];
    }
}
