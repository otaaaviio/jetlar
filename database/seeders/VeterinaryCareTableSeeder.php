<?php

namespace Database\Seeders;

use App\Models\VeterinaryCare;
use Illuminate\Database\Seeder;

class VeterinaryCareTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VeterinaryCare::create(['veterinary_care' => 'Castrado']);
        VeterinaryCare::create(['veterinary_care' => 'Vacinado']);
        VeterinaryCare::create(['veterinary_care' => 'Vermifugado']);
        VeterinaryCare::create(['veterinary_care' => 'Precisa de cuidados especiais']);
    }
}
