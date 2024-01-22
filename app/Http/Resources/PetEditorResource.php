<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Pet
 */
class PetEditorResource extends JsonResource
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
            'pet_id' => $this->pet_id,
            'name' => $this->name,
            'specie_id' => $this->specie_id,
            'gender_id' => $this->gender_id,
            'size_id' => $this->size_id,
            'life_stage_id' => $this->life_stage_id,
            'description' => $this->description,
            'temperaments' => $this->temperaments->pluck('temperament_id')->map(fn($item) => (string)$item)->all(),
            'sociable_with' => $this->sociableWith->pluck('sociable_with_id')->map(fn($item) => (string)$item)->all(),
            'suitable_livings' => $this->suitableLivings->pluck('suitable_living_id')->map(fn($item) => (string)$item)->all(),
            'veterinary_cares' => $this->veterinaryCares->pluck('veterinary_care_id')->map(fn($item) => (string)$item)->all(),
            'pet_images' => $this->images,
        ];
    }
}
