<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    protected $fillable = ['name', 'gender','birthdate', 'age', 'height', 'weight'];

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function hasilPrestasis()
    {
        return $this->hasMany(HasilPrestasi::class);
    }
    
    

}

