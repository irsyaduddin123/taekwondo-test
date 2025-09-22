<?php

// database/seeders/AnnualPlanSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;
use App\Models\Microcycle;
use App\Models\Event;

class AnnualPlanSeeder extends Seeder
{
    public function run(): void
    {
        // Buat plan tahun 2025
        $plan = Plan::create([
            'tahun' => 2025,
            'nama'  => 'Annual Training Plan 2025'
        ]);

        // Tambah microcycles (contoh minggu 1-10)
        $faseList = [
            1 => ['fase' => 'Persiapan Umum I', 'tahap' => 'Fase 1'],
            5 => ['fase' => 'Persiapan Khusus I', 'tahap' => 'Fase 2'],
            9 => ['fase' => 'Kompetisi I', 'tahap' => 'Fase 3'],
        ];

        for ($week = 1; $week <= 10; $week++) {
            $fase = $faseList[$week]['fase'] ?? 'Persiapan Umum I';
            $tahap = $faseList[$week]['tahap'] ?? 'Fase 1';

            Microcycle::create([
                'plan_id'   => $plan->id,
                'minggu'    => $week,
                'fase'      => $fase,
                'tahap'     => $tahap,
                'load'      => rand(2, 10) * 10,
                'phys_prep' => rand(30, 90),
                'tech_prep' => rand(20, 80),
                'volume'    => rand(20, 70),
                'intensity' => rand(30, 90),
            ]);
        }

        // Tambah beberapa events contoh
        Event::create([
            'plan_id'        => $plan->id,
            'nama'           => 'Training Camp Bandung',
            'lokasi'         => 'Bandung',
            'tanggal_mulai'  => '2025-02-10',
            'tanggal_selesai'=> '2025-02-15',
            'keterangan'     => 'Persiapan Umum'
        ]);

        Event::create([
            'plan_id'        => $plan->id,
            'nama'           => 'Seleksi Nasional',
            'lokasi'         => 'Jakarta',
            'tanggal_mulai'  => '2025-04-05',
            'tanggal_selesai'=> '2025-04-08',
            'keterangan'     => 'Kualifikasi'
        ]);

        Event::create([
            'plan_id'        => $plan->id,
            'nama'           => 'Kejuaraan Asia',
            'lokasi'         => 'Korea',
            'tanggal_mulai'  => '2025-07-15',
            'tanggal_selesai'=> '2025-07-23',
            'keterangan'     => 'Kompetisi Utama'
        ]);
    }
}
