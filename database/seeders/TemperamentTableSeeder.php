<?php

namespace Database\Seeders;

use App\Models\Temperament;
use Illuminate\Database\Seeder;

class TemperamentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Temperament::create(['temperament' => 'Agressivo']);
        Temperament::create(['temperament' => 'Arisco']);
        Temperament::create(['temperament' => 'Brincalhão']);
        Temperament::create(['temperament' => 'Calmo']);
        Temperament::create(['temperament' => 'Carente']);
        Temperament::create(['temperament' => 'Dócil']);
        Temperament::create(['temperament' => 'Independente']);
        Temperament::create(['temperament' => 'Sociável']);
    }
}
