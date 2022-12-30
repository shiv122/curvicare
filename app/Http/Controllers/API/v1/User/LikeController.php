<?php

namespace App\Http\Controllers\API\v1\User;

use App\Models\Blog;
use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * @group User Like
 * 
 * APIs for User To Like/Unlike 
 */

class LikeController extends Controller
{


    /**
     * Toggle Like Blog
     * 
     * This endpoint is used to like/unlike a blog
     * 
     * @bodyParam blog_id int required The id of the blog to like/unlike Example: 1
     * 
     * @response {
     *  "status": "success",
     *  "message": "You have successfully liked/un-liked {blog_title}"
     * }
     */


    public function toggleBlog(Request $request)
    {
        $request->validate([
            'blog_id' => 'required|int',
        ]);

        $blog = Blog::findOrFail($request->blog_id);
        $user = $request->user();
        $resp = $user->toggleLike($blog);

        return response()->json([
            'status' => 'success',
            'message' => 'You have successfully ' . $resp . ' ' . $blog->title,
            'liked' => ($resp == 'liked' ? true : false)
        ]);
    }


    /**
     * Toggle Like for Recipe
     * 
     * This endpoint is used to like/unlike a recipe
     * 
     * @bodyParam recipe_id int required The id of the recipe to like/unlike Example: 1
     * 
     * @response {
     *  "status": "success",
     *  "message": "You have successfully liked/un-liked {recipe_title}"
     * }
     */


    public function toggleRecipe(Request $request)
    {
        $request->validate([
            'recipe_id' => 'required|int',
        ]);

        $recipe = Recipe::findOrFail($request->recipe_id);
        $user = $request->user();
        $resp = $user->toggleLike($recipe);

        return response()->json([
            'status' => 'success',
            'message' => 'You have successfully ' . $resp . ' ' . $recipe->title,
            'liked' => ($resp == 'liked' ? true : false)
        ]);
    }
}
