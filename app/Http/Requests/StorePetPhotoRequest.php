<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class StorePetPhotoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pet_photos' => 'required|array',
            'pet_photos.*' => ['file', 'image', 'max:10240'], // 10 MB
            'file_id' => 'nullable|integer|exists:files,id',
        ];
    }

    public function getUploadedImage(): ?UploadedFile
    {
        return $this->file('pet_photo');
    }
}
