<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    protected $fillable = ['tahun','nama'];

    public function microcycles() {
        return $this->hasMany(Microcycle::class);
    }
    public function events() {
        return $this->hasMany(Event::class);
    }
    public function biomotors()
{
    return $this->hasMany(Biomotor::class);
}
public function skills()
{
    return $this->hasMany(Skill::class);
}

    
}
