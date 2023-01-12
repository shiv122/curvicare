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
        $breakfast = $assignments->where('for', 'breakfast');
        $lunch = $assignments->where('for', 'lunch');
        $dinner = $assignments->where('for', 'dinner');
        $pre_snack = $assignments->where('for', 'pre_snack');
        $post_snack = $assignments->where('for', 'post_snack');


        return [$breakfast, $lunch, $dinner, $pre_snack, $post_snack];
    }
}
