<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPrestasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'athlete_id',
        'nama_kejuaraan',
        'kelas_pertandingan',
        'hasil_pertandingan',
        'evaluasi_pelatih',
        'evaluasi_pribadi',
    ];

    public function athlete()
    {
        return $this->belongsTo(Athlete::class);
    }
}
