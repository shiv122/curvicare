<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function media()
    {
        return $this->hasMany(ProductMedia::class);
    }

    public function scopeActive($query, $status = 'active')
    {
        return $query->where('status', $status);
    }
}
