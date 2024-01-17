<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetRequest;
use App\Http\Resources\PetDetailedResource;
use App\Http\Resources\PetResource;
use App\Models\Pet;
use App\Services\PetService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class PetController extends Controller
{
    public function __construct(
        protected readonly PetService $petService
    ) {
    }

    public function index(): ResourceCollection
    {
        return PetResource::collection(
            Pet::orderBy('id')->paginate()
        );
    }

    public function show(Pet $pet): JsonResource
    {
        $pet->load('sociable_with', 'suitable_livings', 'veterinary_cares');
        return PetDetailedResource::make($pet);
    }

    public function store(StorePetRequest $request): JsonResource
    {
        return PetDetailedResource::make(
            $this->petService->upsertPet($request)
        );
    }

    public function update(StorePetRequest $request, Pet $pet): JsonResource
    {
        return PetDetailedResource::make(
            $this->petService->upsertPet($request, $pet)
        );
    }

    public function destroy(Pet $pet): Response
    {
        $this->petService->deletePet($pet);
        return response()->noContent();
    }
}