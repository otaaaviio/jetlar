<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetImageRequest;
use App\Http\Resources\PetImageResource;
use App\Models\Pet;
use App\Models\Image;
use App\Services\PetService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class PetImageController extends Controller
{
    public function __construct(
        protected readonly PetService $petService
    ) {
    }

    public function store(StorePetImageRequest $request): JsonResource
    {                   
        return PetImageResource::make();
    }

    public function destroy(Pet $pet, Image $image): Response
    {
        $this->petService->deleteImage($pet, $image);
        return response()->noContent();
    }
}
