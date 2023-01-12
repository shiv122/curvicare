<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeComposition extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function nutrient()
    {
        return $this->belongsTo(Nutrient::class);
    }

    public function getPercentageAttribute()
    {
        return $this->pivot->percentage;
    }
}
