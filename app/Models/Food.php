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
        // return  $this->hasMany(FoodIngredient::class)->with(['ingredient']);

        return $this->belongsToMany(Ingredient::class,  'food_ingredients', 'food_id', 'ingredient_id')->withPivot('quantity', 'unit')->as('quantity');
    }




    public function images()
    {
        return  $this->hasMany(FoodImage::class);
    }
}
