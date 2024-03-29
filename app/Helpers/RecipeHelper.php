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


    public function  getAssignmentsByMeal($assignments, string $for)
    {
        $breakfast = $assignments->where('for', $for);
        return $breakfast;
    }
}
