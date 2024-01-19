<?php

namespace App\Services;

use App\Http\Requests\StorePetPhotoRequest;
use App\Http\Requests\StorePetRequest;
use App\Models\Pet;
use App\Models\File;
use App\Models\PetPhoto;
use App\Models\VeterinaryCare;
use App\Models\SuitableLiving;
use App\Models\SociableWith;

class PetService
{
    public function __construct(
        private readonly FileService $fileService
    ) {
    }

    public function upsertPet(StorePetRequest $request, ?Pet $pet = null): Pet
    {
        return \DB::transaction(function () use ($request, $pet) {
            if ($pet === null) {
                $pet = $this->createPet($request);
            } else {
                $pet = $this->updatePet($request, $pet);
            }

            return $pet;
        });
    }

    public function attachPhotos(StorePetPhotoRequest $request, Pet $pet): Pet
    {
        return \DB::transaction(function () use ($request, $pet) {
            $uploadedImages = $request->file('photo');

            if ($uploadedImages === null) {
                return $pet;
            }

            foreach ($uploadedImages as $uploadedImage) {
                $file = $this->fileService->store($uploadedImage);
                $petPhoto = new PetPhoto(['file_id' => $file->id]);
                $pet->pet_photos()->save($petPhoto);
            }

            return $pet;
        });
    }

    private function updatePetRelations(StorePetRequest $request, Pet $pet): void
    {
        $veterinaryCares = array_map(function ($name) {
            return VeterinaryCare::firstOrCreate(['veterinary_care' => $name]);
        }, $request->input('veterinary_cares'));
        $pet->veterinary_cares()->saveMany($veterinaryCares);

        $suitableLivings = array_map(function ($name) {
            return SuitableLiving::firstOrCreate(['suitable_living' => $name]);
        }, $request->input('suitable_livings'));
        $pet->suitable_livings()->saveMany($suitableLivings);

        $sociableWith = array_map(function ($name) {
            return SociableWith::firstOrCreate(['sociable_with' => $name]);
        }, $request->input('sociable_with'));
        $pet->sociable_with()->saveMany($sociableWith);

        $petPhotos = PetPhoto::find($request->input('pet_photos'));
        $pet->pet_photos()->saveMany($petPhotos);
    }

    private function createPet(StorePetRequest $request): Pet
    {
        $data = $request->validated();
        unset($data['veterinary_cares'], $data['suitable_livings'], $data['sociable_with']);

        $pet = Pet::create($data);

        $this->updatePetRelations($request, $pet);

        return $pet;
    }

    private function updatePet(StorePetRequest $request, Pet $pet): Pet
    {
        $data = $request->validated();
        unset($data['veterinary_cares'], $data['suitable_livings'], $data['sociable_with']);

        $pet->update($data);

        $this->updatePetRelations($request, $pet);

        return $pet;
    }


    public function deletePhoto($pet, File $file): void
    {
        $pet->photo()->dissociate();
        $pet->save();
        $this->fileService->delete($file);
    }

    public function deletePet(Pet $pet): void
    {
        \DB::transaction(function () use ($pet) {
            if ($pet->photo !== null) {
                $this->fileService->delete($pet->photo);
            }

            $pet->delete();
        });
    }
}
