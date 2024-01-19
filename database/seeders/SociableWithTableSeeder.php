<?php

namespace Database\Seeders;

use App\Models\SociableWith;
use Illuminate\Database\Seeder;

class SociableWithTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SociableWith::create(['sociable_with' => 'Cachorros']);
        SociableWith::create(['sociable_with' => 'Gatos']);
        SociableWith::create(['sociable_with' => 'Crianças']);
        SociableWith::create(['sociable_with' => 'Pessoas desconhecidas']);
    }
}
