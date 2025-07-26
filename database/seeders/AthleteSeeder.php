<?php

namespace Database\Seeders;

use App\Models\Athlete;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AthleteSeeder extends Seeder
{
    public function run(): void
    {
        Athlete::insert([
            [
                'name' => 'Gavriel',
                'gender' => 'Laki-laki',
                'age' => '15',
                'height' => '150',
                'weight' => '70',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Irsyad',
                'gender' => 'Laki-laki',
                'age' => '22',
                'height' => '176',
                'weight' => '80',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
