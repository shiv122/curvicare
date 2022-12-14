<?php

namespace App\Http\Controllers\API\v1\User;

use App\Helpers\RecipeHelper;
use App\Models\Faq;
use App\Models\Blog;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Package;
use App\Models\UserGoal;
use App\Models\Expertise;
use App\Models\MoodQuote;
use App\Models\FaqCategory;
use App\Models\Testimonial;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Models\MedicalCondition;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Http\Resources\Misc\FaqResource;
use App\Http\Resources\Misc\BlogResource;
use App\Http\Resources\Misc\QuoteResource;
use App\Http\Resources\Package\PackageResource;
use App\Http\Resources\Misc\FaqCategoryResource;
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
        $user = User::where('id', $request->user()->id)
            ->with(['user_data' => ['user_goal', 'user_activity'], 'medical_conditions'])
            ->first();

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

        $quote = MoodQuote::inRandomOrder()
            ->with(['mood'])
            ->first();
        return QuoteResource::make($quote);
    }


    /**
     * Recipes
     * 
     * This endpoint is used to get list of recipes.
     * 
     */

    public function recipes(Request $request, RecipeHelper $recipeHelper)
    {
        $user = $request->user();
        $recipes = Recipe::with([
            'foods' => ['ingredients', 'images'],
            'compositions',
            'tags',
        ])->simplePaginate(30);

        $recipes = $recipeHelper->filterPaidRecipes($recipes, $user->isCurrentlySubscribed());


        return RecipeResource::collection($recipes);
    }

    /**
     * Blogs
     * 
     * This endpoint is used to get list of blogs.
     */

    public function blogs(Request $request, RecipeHelper $recipeHelper)
    {
        $blogs = Blog::with([
            'direct_tags',
            'images',
            'dietician',
        ])->simplePaginate(30);



        $blogs = $recipeHelper->filterPaidBlogs($blogs, $request->user()->isCurrentlySubscribed());


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
            'user_activities' => UserActivity::get(),
            'user_goals' => UserGoal::get(),
            'medical_conditions' => MedicalCondition::get(),
            'expertise' => Expertise::active()->get(),
        ];

        return response()->json($data);
    }


    /**
     * Featured Faqs
     * 
     * This endpoint is used to get list of faqs.
     */

    public function faqs()
    {
        $faqs =  Faq::active()
            ->isFeatured()
            ->get();

        return FaqResource::collection($faqs);
    }

    /**
     * Faq Categories
     * 
     * This endpoint is used to get list of faq categories.
     */


    public function faqCategories()
    {
        $categories = FaqCategory::with('faqs')->get();

        return FaqCategoryResource::collection($categories);
    }


    /**
     * Packages
     * 
     * This endpoint is used to get list of packages.
     */

    public function packages()
    {
        $packages = Package::active()->with([
            'prices',
            'features',
        ])->get();

        return PackageResource::collection($packages);
    }
}
