<?php

namespace App\Helpers;



class RecipeHelper
{



    public function filterPaidRecipes($recipes, $currentlySubscribed)
    {
        foreach ($recipes as $key => $recipe) {
            if ($recipe->is_paid === 'yes' && !$currentlySubscribed) {
                unset($recipe->description);
                unset($recipe->caution);
                unset($recipe->foods);
                unset($recipe->compositions);
                unset($recipe->tags);
            }
        }

        return $recipes;
    }


    public function  getAssignmentsByMeal($assignments)
    {
        $breakfast = $assignments->where('for', 'breakfast')->pluck('recipe');
        $lunch = $assignments->where('for', 'lunch')->pluck('recipe');
        $dinner = $assignments->where('for', 'dinner')->pluck('recipe');
        $snacks = $assignments->where('for', 'snacks')->pluck('recipe');

        return [$breakfast, $lunch, $dinner, $snacks];
    }
}
