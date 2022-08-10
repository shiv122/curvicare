<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'ingredients';

    //active scope
    public function scopeActive($query, $status = 'active')
    {
        return $query->where('status', $status);
    }
}
