<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pet;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GenderTableSeeder::class,
            LifeStageTableSeeder::class,
            SizeTableSeeder::class,
            SociableWithTableSeeder::class,
            SpecieTableSeeder::class,
            SuitableLivingTableSeeder::class,
            TemperamentTableSeeder::class,
            VeterinaryCareTableSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'asd@asd.com',
            'password' => 'asdasd',
        ]);

        Pet::factory(40)->create();
    }
}
