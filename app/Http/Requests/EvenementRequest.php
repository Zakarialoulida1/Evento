<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvenementRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'available_places' => 'required|integer|min:0',
            'type_of_reservation' => 'required|in:Automatique,par_confirmation',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ];
    }
}
