<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;
use App\Models\Microcycle;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Plan contoh
        $plan = Plan::create([
            'nama_plan' => 'Program Tahunan Atlet Angkat Berat',
            'tahun' => 2025,
        ]);

        // Buat Microcycle contoh (minggu 1 - 12)
        for ($i = 1; $i <= 12; $i++) {
            Microcycle::create([
                'plan_id' => $plan->id,
                'week' => $i,
                'load' => rand(50, 100),
                'volume' => rand(60, 120),
                'intensity' => rand(40, 90),
                'peaking' => ($i % 4 == 0) ? rand(70, 100) : null, // peaking tiap 4 minggu
            ]);
        }
    }
}
