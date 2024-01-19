<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePetRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'specie' => 'required|string',
            'gender' => 'required|string',
            'size' => 'required|string',
            'age' => 'required|string',
            'temperament' => 'required|string',
            'description' => 'nullable|string',
            'photo_id' => 'nullable|integer|exists:files,id',
            'pet_photos' => 'required|array',
            'pet_photos.*' => 'required|file|distinct',
            'veterinary_cares' => 'required|array',
            'veterinary_cares.*' => 'required|string|distinct',
            'suitable_livings' => 'required|array',
            'suitable_livings.*' => 'required|string|distinct',
            'sociable_with' => 'required|array',
            'sociable_with.*' => 'required|string|distinct',
        ];
    }
}
