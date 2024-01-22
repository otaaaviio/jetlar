<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetRequest;
use App\Http\Resources\PetDetailedResource;
use App\Http\Resources\PetEditorResource;
use App\Http\Resources\PetResource;
use App\Models\Pet;
use App\Services\PetService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class PetController extends Controller
{
    public function __construct(
        protected readonly PetService $petService
    ) {
    }

    public function index(Request $request): ResourceCollection
    {
        $query = Pet::query();

        $filters = [
            'name' => 'ilike',
            'specie_id' => 'whereIn',
            'gender_id' => 'whereIn',
            'size_id' => 'whereIn',
            'life_stage_id' => 'whereIn',
        ];

        foreach ($filters as $filter => $operator) {
            if ($request->has($filter)) {
                $value = $request->$filter;
                if (is_array($value)) {
                    $query->whereIn($filter, $value);
                } else {
                    if ($operator === 'like') {
                        $value = '%' . $value . '%';
                    }
                    $query->where($filter, '=', $value);
                }
            }
        }

        return PetResource::collection($query->orderBy('pet_id')->paginate());
    }

    public function show(Pet $pet): JsonResource
    {
        return PetDetailedResource::make($pet);
    }

    public function fetchPetForEdit($id): JsonResource
    {
        $pet = Pet::find($id);
        return PetEditorResource::make($pet);
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