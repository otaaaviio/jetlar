<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Image
 */
class ImageDetailedResource extends JsonResource
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
            'name' => $this->name,
            'file_name' => $this->file_name,
            'mime_type' => $this->mime_type,
            'path' => $this->path,
            'file_hash' => $this->file_hash,
            'disk' => $this->disk,
            'extension' => $this->extension,
            'size' => $this->size,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
