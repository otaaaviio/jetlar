<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    protected $model = Pet::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name;
        $specie = $this->faker->randomElement(['Canino', 'Felino']);
        $gender = $this->faker->randomElement(['Fêmea', 'Macho']);
        $size = $this->faker->randomElement(['Pequeno', 'Médio', 'Grande']);
        $age = $this->faker->randomElement(['Filhote', 'Adulto', 'Idoso']);
        $temperament = $this->faker->randomElement(['Agressivo', 'Arisco', 'Brincalhão', 'Calmo', 'Carente', 'Dócil', 'Independente', 'Sociável']);

        return [
            'name' => $name,
            'specie' => $specie,
            'gender' => $gender,
            'size' => $size,
            'age' => $age,
            'temperament' => $temperament,
            'description' => $this->faker->text(50),
        ];
    }

    public function configure(): PetFactory
    {
        return $this->afterCreating(function (Pet $pet) {
            File::factory(rand(1, 5))->create(['pet_id' => $pet->id]);

            \DB::table('pet_veterinary_cares')->insert([
                'pet_id' => $pet->id,
                'veterinary_care' => $this->faker->randomElement(['Castrado', 'Vacinado', 'Vermifugado', 'Precisa de cuidados especiais']),
            ]);

            \DB::table('pet_suitable_livings')->insert([
                'pet_id' => $pet->id,
                'suitable_living' => $this->faker->randomElement(['Apartamento', 'Apartamento telado', 'Casa com quintal fechado']),
            ]);

            \DB::table('pet_sociable_with')->insert([
                'pet_id' => $pet->id,
                'sociable_with' => $this->faker->randomElement(['Cachorros', 'Gatos', 'Crianças', 'Pessoas desconhecidas']),
            ]);
        });
    }
}
