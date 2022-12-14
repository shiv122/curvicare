<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dieticians()
    {
        return $this->hasOneThrough(Dietician::class, DieticianExpertise::class, 'expertise_id', 'id', 'id', 'dietician_id');
    }




    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
