<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Microcycle extends Model
{
    //
    protected $fillable = [
        'plan_id','minggu','fase','tahap','load',
        'phys_prep','tech_prep','volume','intensity'
    ];

    public function plan() {
        return $this->belongsTo(Plan::class);
    }
}
