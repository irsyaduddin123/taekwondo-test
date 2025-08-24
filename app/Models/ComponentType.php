<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComponentType extends Model
{
    protected $table = 'component_types';

    protected $fillable = [
        'nama_jenis',
    ];

    // Relasi: satu jenis punya banyak komponen
    public function components()
    {
        return $this->hasMany(TestComponent::class, 'jenis_id');
    }
}
