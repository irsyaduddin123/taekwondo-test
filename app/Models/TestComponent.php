<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestComponent extends Model
{
    protected $table = 'test_components'; // Nama tabel (opsional jika sesuai konvensi)

    protected $fillable = [
        'nama_komponen',
        'jenis',
        'deskripsi', // kalau kamu pakai kolom ini
    ];

    // (Opsional) Jika kamu punya relasi dengan model lain, bisa ditambahkan di sini.
    // Misal: satu komponen bisa digunakan di banyak hasil tes

    // public function testResults()
    // {
    //     return $this->hasMany(TestResult::class);
    // }
}
