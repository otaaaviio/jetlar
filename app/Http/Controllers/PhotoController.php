<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePetPhotoRequest;
use App\Http\Resources\PhotoResource;
use App\Models\File;
use App\Services\FileService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class PhotoController extends Controller
{
    public function __construct(
        protected readonly FileService $fileService
    ) {
    }

    public function show(File $photo): JsonResource
    {
        return PhotoResource::make($photo);
    }

    public function store(StorePetPhotoRequest $request): JsonResource
    {
        return PhotoResource::make(
            $this->fileService->store($request->getUploadedImage())
        );
    }

    public function destroy(File $photo): Response
    {
        $this->fileService->delete($photo);
        return response()->noContent();
    }
}
