<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{
    use HasFactory, BelongsToThrough;


    protected $guarded = [];



    public function template_recipes()
    {
        return $this->hasMany(TemplateRecipe::class);
    }

    public function recipes()
    {
        return $this->belongsToThrough(
            TemplateRecipe::class,
            Recipe::class,
        );
    }






    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
