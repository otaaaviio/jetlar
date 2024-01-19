<?php

namespace Database\Seeders;

use App\Models\LifeStage;
use Illuminate\Database\Seeder;

class LifeStageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LifeStage::create(['life_stage' => 'Filhote']);
        LifeStage::create(['life_stage' => 'Adulto']);
        LifeStage::create(['life_stage' => 'Idoso']);
    }
}
