<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // insert master jenis komponen
        $fisikId = DB::table('component_types')->insertGetId([
            'nama_jenis' => 'Fisik',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $teknikId = DB::table('component_types')->insertGetId([
            'nama_jenis' => 'Teknik',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // insert test components dengan relasi ke jenis_id
        DB::table('test_components')->insert([
            ['nama_komponen' => 'Lari 40m', 'jenis_id' => $fisikId, 'created_at' => now(), 'updated_at' => now()],
            ['nama_komponen' => 'Push Up', 'jenis_id' => $fisikId, 'created_at' => now(), 'updated_at' => now()],
            ['nama_komponen' => 'Tendangan Tinggi', 'jenis_id' => $teknikId, 'created_at' => now(), 'updated_at' => now()],
            ['nama_komponen' => 'Pukulan Cepat', 'jenis_id' => $teknikId, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
