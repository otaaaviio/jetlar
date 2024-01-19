<?php

namespace Database\Seeders;

use App\Models\SuitableLiving;
use Illuminate\Database\Seeder;

class SuitableLivingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SuitableLiving::create(['suitable_living' => 'Apartamento']);
        SuitableLiving::create(['suitable_living' => 'Apartamento telado']);
        SuitableLiving::create(['suitable_living' => 'Casa com quintal fechado']);
    }
}
