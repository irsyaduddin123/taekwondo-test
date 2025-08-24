<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestComponent extends Model
{
    protected $table = 'test_components';

    protected $fillable = [
        'nama_komponen',
        'jenis_id',
        'deskripsi',
    ];

    // Relasi: satu komponen dimiliki oleh satu jenis
    public function type()
    {
        return $this->belongsTo(ComponentType::class, 'jenis_id');
    }
}
