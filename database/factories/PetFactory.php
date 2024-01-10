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

        $name = $this->faker->randomElement(['annie', 'arya', 'loki', 'laila']);
        $specie = $this->faker->randomElement(['Canino', 'Felino']);
        $gender = $this->faker->randomElement(['Fêmea', 'Macho']);
        $size = $this->faker->randomElement(['Pequeno', 'Médio', 'Grande']);
        $age = $this->faker->randomElement(['Filhote', 'Adulto', 'Idoso']);
        $veterinary_care = $this->faker->randomElement(['Castrado', 'Vacinado', 'Vermifugado', 'Precisa de cuidados especiais']);
        $temperament = $this->faker->randomElement(['Agressivo', 'Arisco', 'Brincalhão', 'Calmo', 'Carente', 'Dócil', 'Independente', 'Sociável']);
        $suitable_living = $this->faker->randomElement(['Apartamento', 'Apartamento telado', 'Casa com quintal fechado']);
        $sociable_with = $this->faker->randomElement(['Cachorros', 'Gatos', 'Crianças', 'Pessoas desconhecidas']);

        return [
            'name' => $name,
            'specie' => $specie,
            'gender' => $gender,
            'size' => $size,
            'age' => $age,
            'veterinary_care' => $veterinary_care,
            'temperament' => $temperament,
            'suitable_living' => $suitable_living,
            'sociable_with' => $sociable_with,
            'description' => $this->faker->text(50),
            'cover_id' => File::factory()->create(),
        ];
    }
}
