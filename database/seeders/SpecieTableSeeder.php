<?php

namespace Database\Seeders;

use App\Models\Specie;
use Illuminate\Database\Seeder;

class SpecieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Specie::create(['specie' => 'Canino']);
        Specie::create(['specie' => 'Felino']);
    }
}
