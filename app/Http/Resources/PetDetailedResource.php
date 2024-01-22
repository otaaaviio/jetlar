<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Pet
 */
class PetDetailedResource extends JsonResource
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
            'specie' => $this->specie->specie,
            'gender' => $this->gender->gender,
            'size' => $this->size->size,
            'life_stage' => $this->lifeStage->life_stage,
            'description' => $this->description,
            'temperaments' => $this->temperaments->pluck('temperament'),
            'sociable_with' => $this->sociableWith->pluck('sociable_with'),
            'suitable_livings' => $this->suitableLivings->pluck('suitable_living'),
            'veterinary_cares' => $this->veterinaryCares->pluck('veterinary_care'),
            'images' => $this->images->pluck('path'),
        ];
    }
}
