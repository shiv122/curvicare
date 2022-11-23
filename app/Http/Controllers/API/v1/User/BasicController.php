<?php

namespace App\Http\Controllers\API\v1\User;

use App\Models\Blog;
use App\Models\Recipe;
use App\Models\MoodQuote;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Http\Resources\Misc\BlogResource;
use App\Http\Resources\Misc\QuoteResource;
use App\Http\Resources\Misc\TestimonialsResource;



/**
 * @group User Basic
 * 
 * APIs for basic data
 */


class BasicController extends Controller
{



    /**
     * Profile
     * 
     * This endpoint is used to get user profile data
     * 
     */

    public function profile(Request $request)
    {
        $user = $request->user();

        return response()->json($user);
    }


    /**
     * Update Profile
     * 
     * This endpoint is used to update user profile data
     * 
     */

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'dob' => 'required|date',
            'user_activity_id' => 'required|integer|exists:user_activities,id',
            'user_goal_id' => 'required|integer|exists:user_goals,id',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'medical_conditions' => 'nullable|array',
            'medical_conditions.*' => 'nullable|exists:medical_conditions,id',
            'gender' => 'required|in:male,female,other|string',
        ]);

        $user = $request->user();


        DB::beginTransaction();

        $user->update($request->only([
            'name',
        ]));

        $user->user_data()->create($request->only([
            'dob',
            'user_activity_id',
            'user_goal_id',
            'weight',
            'height',
            'gender',
        ]));


        if ($request->has('medical_conditions')) {
            foreach ($request->medical_conditions as $condition) {
                $user->medical_conditions()->create([
                    'medical_condition_id' => $condition,
                ]);
            }
        }

        DB::commit();


        return response()->json($user);
    }


    /**
     * Quotes
     * 
     * This endpoint is used to get random quotes
     */

    public function quotes(Request $request)
    {
        $quote = MoodQuote::inRandomOrder()->first();
        return QuoteResource::make($quote);
    }


    /**
     * Recipes
     * 
     * This endpoint is used to get list of recipes.
     */

    public function recipes()
    {
        $recipes = Recipe::with([
            'foods' => ['ingredients', 'images'],
            'compositions',
            'tags',
        ])->get();

        return RecipeResource::collection($recipes);
    }

    /**
     * Blogs
     * 
     * This endpoint is used to get list of blogs.
     */

    public function blogs()
    {
        $blogs = Blog::with([
            'direct_tags',
            'images',
            'dietician',
        ])->get();


        return BlogResource::collection($blogs);
    }

    /** 
     * Testimonials
     * 
     * This endpoint is used to get list of testimonials.
     */

    public function testimonials()
    {
        $testimonials = Testimonial::active()->get();

        return TestimonialsResource::collection($testimonials);
    }

    /**
     * Metadata
     * 
     * This endpoint is used to get metadata for the app like user goals, user activities, medical conditions etc.
     */

    public function metadata()
    {
        $data = [
            'user_activities' => DB::table('user_activities')->get(),
            'user_goals' => DB::table('user_goals')->get(),
            'medical_conditions' => DB::table('medical_conditions')->get(),
        ];

        return response()->json($data);
    }
}
