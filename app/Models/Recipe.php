<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;

class Recipe extends Model
{
    use HasFactory, BelongsToThrough;
    protected $guarded = [];

    public function foods()
    {
        // return $this->hasMany(RecipeFood::class, 'recipe_id')->with('food');
        return $this->belongsToMany(Food::class,  'recipe_food', 'recipe_id', 'food_id');
    }


    public function compositions()
    {
        return $this->belongsToMany(Nutrient::class,  'recipe_compositions', 'recipe_id', 'nutrient_id')->withPivot('percentage')->as('quantity');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class,  'recipe_tags', 'recipe_id', 'tag_id');
        // ->where('tags.status', 'active');
    }
}
