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
            'pet_id' => $this->pet_id,
            'name' => $this->name,
            'life_stage' => $this->lifeStage->life_stage,
            'size' => $this->size->size,
            'image_path' => optional($this->images->first())->path,
        ];
    }
}