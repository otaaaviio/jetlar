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
            'specie_id' => 'required|integer',
            'gender_id' => 'required|integer',
            'size_id' => 'required|integer',
            'life_stage_id' => 'required|integer',
            'description' => 'nullable|string',
            'pet_images' => 'required|array',
            'pet_images.*' => 'required|file|distinct',
            'temperaments' => 'required|array',
            'temperaments.*' => 'required|string|distinct',
            'veterinary_cares' => 'required|array',
            'veterinary_cares.*' => 'required|string|distinct',
            'suitable_livings' => 'required|array',
            'suitable_livings.*' => 'required|string|distinct',
            'sociable_with' => 'required|array',
            'sociable_with.*' => 'required|string|distinct',
        ];
    }
}
