<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class FoodIngredient extends Pivot
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'food_ingredients';

    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
