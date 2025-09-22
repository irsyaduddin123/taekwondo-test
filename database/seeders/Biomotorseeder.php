<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Biomotor;
use App\Models\Plan;

class BiomotorSeeder extends Seeder
{
    public function run(): void
    {
        $plan = Plan::first(); // ambil plan pertama, bisa diganti sesuai kebutuhan

        if ($plan) {
            $komponenList = ['Kekuatan', 'Daya Tahan', 'Kecepatan', 'Kelenturan'];
            $faseList = ['Foundation', 'Development', 'Competition'];

            for ($minggu = 1; $minggu <= 8; $minggu++) {
                foreach ($komponenList as $komponen) {
                    Biomotor::create([
                        'plan_id'    => $plan->id,
                        'komponen'   => $komponen,
                        'fase'       => $faseList[array_rand($faseList)], // random fase
                        'minggu'     => $minggu,
                        'keterangan' => "Latihan {$komponen} untuk minggu ke-{$minggu}"
                    ]);
                }
            }
        }
    }
}
