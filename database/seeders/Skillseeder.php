<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;
use App\Models\Plan;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plan = Plan::first(); // ambil plan pertama

        if ($plan) {
            $skills = [
                [
                    'plan_id' => $plan->id,
                    'komponen' => 'Teknik Dasar',
                    'fase' => 'Foundation',
                    'minggu' => '1',
                    'keterangan' => 'Latihan kontrol bola dan passing dasar',
                ],
                [
                    'plan_id' => $plan->id,
                    'komponen' => 'Strategi',
                    'fase' => 'Development',
                    'minggu' => '4',
                    'keterangan' => 'Penerapan strategi menyerang',
                ],
                [
                    'plan_id' => $plan->id,
                    'komponen' => 'Koordinasi',
                    'fase' => 'Competition',
                    'minggu' => '8',
                    'keterangan' => 'Latihan koordinasi tim penuh',
                ],
            ];

            foreach ($skills as $skill) {
                Skill::create($skill);
            }
        }
    }
}
