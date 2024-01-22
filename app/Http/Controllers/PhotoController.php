<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetImageRequest;
use App\Http\Resources\PetImageResource;
use App\Models\Image;
use App\Services\ImageService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    public function __construct(
        protected readonly ImageService $imageService
    ) {
    }

    public function show(Image $image): JsonResource
    {
        return PetImageResource::make($image);
    }

    public function store(StorePetImageRequest $request): JsonResource
    {
        return PetImageResource::make(
            $this->imageService->store($request->getUploadedImage())
        );
    }

    public function destroy(Image $image): Response
    {
        $this->imageService->delete($image);
        return response()->noContent();
    }
}
