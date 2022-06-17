<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function ingredients()
    {
        return  $this->hasMany(FoodIngredient::class)->with(['ingredient']);
    }

    public function images()
    {
        return  $this->hasMany(FoodImage::class);
    }
}
