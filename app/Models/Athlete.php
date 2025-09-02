<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    protected $fillable = ['name', 'gender', 'age', 'height', 'weight'];

    public function testResults()
    {
        return $this->hasMany(TestResult::class);
    }
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
}

