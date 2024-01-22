<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class StorePetImageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pet_images' => 'required|array',
            'pet_images.*' => ['file', 'image', 'max:10240'], // 10 MB
            'image_id' => 'nullable|integer|exists:image,id',
        ];
    }

    public function getUploadedImage(): ?UploadedFile
    {
        return $this->image('pet_image');
    }
}
