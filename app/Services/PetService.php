<?php

namespace App\Services;

use App\Http\Requests\StorePetPhotoRequest;
use App\Http\Requests\StorePetRequest;
use App\Models\Pet;
use App\Models\File;

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

            $this->updatePetRelations($request, $pet);

            return $pet;
        });
    }

    public function attachPhoto(StorePetPhotoRequest $request, Pet $pet): Pet
    {
        return \DB::transaction(function () use ($request, $pet) {
            if ($request->getUploadedImage() === null) {
                return $pet;
            }

            $file = $this->fileService->store($request->getUploadedImage());
            $pet->photo()->associate($file);
            $pet->save();
            return $pet;
        });
    }

    private function updatePetRelations(StorePetRequest $request, Pet $pet): void
    {
        $pet->veterinary_cares()->sync($request->input('veterinary_cares'));

        $pet->suitable_livings()->sync($request->input('suitable_livings'));

        $pet->sociable_with()->sync($request->input('sociable_with'));
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
