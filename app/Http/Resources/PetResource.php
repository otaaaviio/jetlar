<?php

namespace App\Http\Resources;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Pet
 */
class PetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'age' => $this->age,
            'size' => $this->size,
            'photo' => PhotoResource::make($this->photo),
        ];
    }
}