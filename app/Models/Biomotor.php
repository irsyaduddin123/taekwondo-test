<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biomotor extends Model
{
    //
    protected $table = 'biomotor';
    protected $fillable = ['plan_id','minggu','komponen','fase','keterangan'];

    public function plan() {
        return $this->belongsTo(Plan::class);
    }
}
