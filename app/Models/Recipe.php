<?php

namespace App\Models;

use App\Traits\Likable;
use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory, BelongsToThrough, Likable;
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









    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
