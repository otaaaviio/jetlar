<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pet;
use App\Models\File;
use App\Models\PetPhoto;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'asd@asd.com',
            'password' => 'asdasd',
        ]);

        Pet::factory(40)->create()->each(function ($pet) {
            $files = File::factory(rand(1, 5))->create(['pet_id' => $pet->id]);

            $mainPhoto = $files->first();
            $pet->photo_id = $mainPhoto->id;
            $pet->save();

            $files->each(function ($file) use ($pet) {
                PetPhoto::create([
                    'pet_id' => $pet->id,
                    'file_id' => $file->id,
                ]);
            });
        });
    }
}
