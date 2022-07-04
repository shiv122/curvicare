<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mood extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function scopeActive($query,  $status = 'active')
    {
        return $query->where('status', $status);
    }
}
