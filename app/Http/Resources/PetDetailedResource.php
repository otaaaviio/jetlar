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
            'id' => $this->id,
            'name' => $this->name,
            'specie' => $this->specie,
            'gender' => $this->gender,
            'size' => $this->size,
            'age' => $this->age,
            'temperament' => $this->temperament,
            'description' => $this->description,
            'photos' => $this->pet_photos->pluck('photo_id'),
            'sociable_with' => $this->sociable_with->pluck('sociable_with'),
            'suitable_livings' => $this->suitable_livings->pluck('suitable_living'),
            'veterinary_cares' => $this->veterinary_cares->pluck('veterinary_care'),
        ];
    }
}
