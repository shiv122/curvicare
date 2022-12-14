<?php

namespace App\Helpers;



class RecipeHelper
{



    public function filterPaidBlogs($recipes, $currentlySubscribed)
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
}
