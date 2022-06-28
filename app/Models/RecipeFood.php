<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RecipeFood extends Pivot
{
    use HasFactory;
    protected $guarded = [];

    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id');
    }
}
