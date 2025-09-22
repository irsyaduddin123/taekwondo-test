<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = ['plan_id','nama','lokasi','tanggal_mulai','tanggal_selesai','keterangan'];

    public function plan() {
        return $this->belongsTo(Plan::class);
    }
}
