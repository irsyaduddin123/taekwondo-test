<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // buat user admin default
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => bcrypt('admin123'),
        ]);

        // panggil seeder lain
        $this->call([
            AthleteSeeder::class,
            TestComponentSeeder::class,
        ]);

        $this->call([
            AnnualPlanSeeder::class,
        ]);
    }
}
