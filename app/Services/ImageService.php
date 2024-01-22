<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function hashFile(UploadedFile $uploadedFile): string
    {
        return hash_file('sha256', $uploadedFile->getRealPath());
    }

    public function store(UploadedFile $uploadedFile, string $folder = 'image'): Image
    {
        $name = $uploadedFile->hashName();
        $disk = config('filesystems.default');

        if (app()->runningUnitTests()) {
            $name = 'temp-' . $name;
        }

        $filePath = Storage::disk($disk)->putFileAs($folder, $uploadedFile, $name, 'public');

        $file = new Image();
        $file->name = $name;
        $file->file_name = $uploadedFile->getClientOriginalName();
        $file->mime_type = $uploadedFile->getMimeType();
        $file->path = $filePath;
        $file->disk = $disk;
        $file->size = $uploadedFile->getSize();
        $file->extension = $uploadedFile->getClientOriginalExtension();
        $file->file_hash = $this->hashFile($uploadedFile);
        $file->save();

        return $file;
    }

    public function delete(Image $image): void
    {
        Storage::disk($image->disk)->delete($image->path);
        $image->delete();
    }

    public function isSameFile(Image $image, UploadedFile $uploadedFile): bool
    {
        return $image->file_hash === $this->hashFile($uploadedFile);
    }
}