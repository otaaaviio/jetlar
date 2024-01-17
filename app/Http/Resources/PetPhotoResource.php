<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\PetPhoto
 */
class PetPhotoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'file' => FileResource::make($this->file),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
