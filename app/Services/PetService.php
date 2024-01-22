<?php

namespace App\Services;

use App\Http\Requests\StorePetImageRequest;
use App\Http\Requests\StorePetRequest;
use App\Models\Pet;
use App\Models\Image;
use Illuminate\Support\Facades\DB;

class PetService
{
    public function __construct(
        private readonly ImageService $imageService
    ) {
    }

    public function upsertPet(StorePetRequest $request, ?Pet $pet = null): Pet
    {
        return DB::transaction(function () use ($request, $pet) {
            if ($pet === null) {
                $pet = $this->createPet($request);
            } else {
                $pet = $this->updatePet($request, $pet);
            }

            return $pet;
        });
    }

    public function attachImages(StorePetRequest $request, Pet $pet): Pet
    {
        return DB::transaction(function () use ($request, $pet) {
            $uploadedImages = $request->file('pet_images');

            if ($uploadedImages === null) {
                return $pet;
            }

            foreach ($uploadedImages as $uploadedImage) {
                $image = $this->imageService->store($uploadedImage);
                $pet->images()->attach($image->image_id);
            }

            return $pet;
        });
    }

    private function updatePetRelations(StorePetRequest $request, Pet $pet): void
    {
        $data = $request->validated();

        if (isset($data['veterinary_cares'])) {
            $pet->veterinaryCares()->sync($data['veterinary_cares']);
        }

        if (isset($data['temperaments'])) {
            $pet->temperaments()->sync($data['temperaments']);
        }

        if (isset($data['suitable_livings'])) {
            $pet->suitableLivings()->sync($data['suitable_livings']);
        }

        if (isset($data['sociable_with'])) {
            $pet->sociableWith()->sync($data['sociable_with']);
        }
    }


    private function createPet(StorePetRequest $request): Pet
    {
        $data = $request->validated();

        $pet = Pet::create($data);

        $this->updatePetRelations($request, $pet);

        $this->attachImages($request, $pet);

        return $pet;
    }

    private function updatePet(StorePetRequest $request, Pet $pet): Pet
    {
        $data = $request->validated();

        $pet->update($data);

        $this->updatePetRelations($request, $pet);

        return $pet;
    }


    public function deletePhoto($pet, Image $image): void
    {
        $pet->image()->dissociate();
        $pet->save();
        $this->imageService->delete($image);
    }

    public function deletePet(Pet $pet): void
    {
        DB::transaction(function () use ($pet) {
            foreach ($pet->images as $image) {
                $this->imageService->delete($image);
                $pet->images()->detach($image->image_id);
            }

            $pet->delete();
        });
    }

}
