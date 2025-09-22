<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $table = 'keterampilan_fisik';

    protected $fillable = [
        'plan_id',
        'komponen',
        'fase',
        'minggu',
        'keterangan',
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
