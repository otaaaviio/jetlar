<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Http\UploadedFile;

class FileService
{
    public function hashFile(UploadedFile $uploadedFile): string
    {
        return hash_file('sha256', $uploadedFile->getRealPath());
    }

    public function store(UploadedFile $uploadedFile, string $folder = 'files'): File
    {
        $name = $uploadedFile->hashName();
        $disk = config('filesystems.default');

        if (app()->runningUnitTests()) {
            $name = 'temp-' . $name;
        }

        $filePath = \Storage::disk($disk)->putFileAs($folder, $uploadedFile, $name, 'public');

        $file = new File();
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

    public function delete(File $file): void
    {
        \Storage::disk($file->disk)->delete($file->path);
        $file->delete();
    }

    public function isSameFile(File $file, UploadedFile $uploadedFile): bool
    {
        return $file->file_hash === $this->hashFile($uploadedFile);
    }
}