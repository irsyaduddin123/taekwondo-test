<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 

class TestComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table('test_components')->insert([
            ['nama_komponen' => 'Lari 40m', 'jenis' => 'fisik'],
            ['nama_komponen' => 'Push Up', 'jenis' => 'fisik'],
            ['nama_komponen' => 'Tendangan Tinggi', 'jenis' => 'teknik'],
            ['nama_komponen' => 'Pukulan Cepat', 'jenis' => 'teknik'],
        ]);
    }
}
