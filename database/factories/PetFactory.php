<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\File;
use App\Models\Temperament;
use App\Models\SuitableLiving;
use App\Models\SociableWith;
use App\Models\VeterinaryCare;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    protected $model = Pet::class;

    public function definition(): array
    {
        $name = $this->faker->name;
        $specie_id = rand(1, 2);
        $gender_id = rand(1, 2);
        $size_id = rand(1, 3);
        $life_stage_id = rand(1, 3);

        return [
            'name' => $name,
            'specie_id' => $specie_id,
            'gender_id' => $gender_id,
            'size_id' => $size_id,
            'life_stage_id' => $life_stage_id,
            'description' => $this->faker->text(255),
        ];
    }

    public function configure(): PetFactory
    {
        return $this->afterCreating(function (Pet $pet) {
            $file = File::factory()->create();
            DB::table('pet_files')->insert([
                'pet_id' => $pet->pet_id,
                'file_id' => $file->file_id
            ]);

            $temperaments = Temperament::all()->random(rand(2, 3));
            $pet->temperaments()->attach($temperaments);

            $suitable_livings = SuitableLiving::all()->random(rand(2, 3));
            $pet->suitableLivings()->attach($suitable_livings);

            $sociable_with = SociableWith::all()->random(rand(2, 3));
            $pet->sociableWith()->attach($sociable_with);

            $veterinary_cares = VeterinaryCare::all()->random(rand(2, 3));
            $pet->veterinaryCares()->attach($veterinary_cares);
        });
    }
}
