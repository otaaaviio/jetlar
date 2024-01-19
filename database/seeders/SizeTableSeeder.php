<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;

class SizeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Size::create(['size' => 'Pequeno']);
        Size::create(['size' => 'Médio']);
        Size::create(['size' => 'Grande']);
    }
}
