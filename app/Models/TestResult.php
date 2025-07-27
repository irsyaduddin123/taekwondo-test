<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = [
        'athlete_id',
        'test_component_id',
        'test_date',
        'score',
    ];

    public function athlete()
    {
        return $this->belongsTo(Athlete::class);
    }

    public function testComponent()
    {
        return $this->belongsTo(TestComponent::class);
    }
}

