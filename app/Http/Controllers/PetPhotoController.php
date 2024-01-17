<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetPhotoRequest;
use App\Http\Resources\PhotoResource;
use App\Models\Pet;
use App\Models\File;
use App\Services\PetService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class PetPhotoController extends Controller
{
    public function __construct(
        protected readonly PetService $petService
    )
    {
    }

    public function store(StorePetPhotoRequest $request): JsonResource
    {
        return PhotoResource::make();
    }

    public function destroy(Pet $pet, File $photo): Response
    {
        $this->petService->deletePhoto($pet, $photo);
        return response()->noContent();
    }
}
