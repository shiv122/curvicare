<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $guarded = [];









    //scopes
    public function scopeActive($query, $active = 'active')
    {
        return $query->where('status', $active);
    }
}
