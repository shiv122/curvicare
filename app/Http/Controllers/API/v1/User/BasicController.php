<?php

namespace App\Http\Controllers\API\v1\User;

use App\Models\Faq;
use App\Models\Blog;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Package;
use App\Models\UserGoal;
use App\Models\Expertise;
use App\Models\MoodQuote;
use App\Helpers\BlogHelper;
use App\Models\FaqCategory;
use App\Models\Testimonial;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use App\Helpers\RecipeHelper;
use App\Models\MedicalCondition;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Services\Agora\RtcTokenBuilder;
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
     * @authenticated
     * 
     * This endpoint is used to get user profile data
     * 
     */

    public function profile(Request $request)
    {
        $user = User::where('id', $request->user()->id)
            ->with([
                'user_data' => ['user_goal', 'user_activity'],
                'medical_conditions',
                'assignments' => function ($q) {
                    return $q->orderBy('created_at', 'desc')->limit(1)->with(['assigned_dieticians' => function ($q) {
                        return $q->orderBy('created_at', 'desc')->limit(1)->with(['dietician']);
                    }]);
                }
            ])
            ->first();

        return response()->json($user);
    }


    /**
     * Update Profile
     * 
     * @authenticated
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
            'target_weight' => 'nullable|numeric',
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
            'target_weight',
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
     * @authenticated
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
     * @authenticated
     * 
     * This endpoint is used to get list of recipes.
     * 
     */

    public function recipes(Request $request, $id = null,)
    {
        $user = $request->user();

        $recipeHelper = new RecipeHelper();

        $recipes = Recipe::with([
            'foods' => ['ingredients', 'images'],
            'compositions',
            'tags',
            'liked' => fn ($q) => $q->where('liker_id', $request->user()->id),
        ])
            ->when($id, function ($q) use ($id) {
                $q->where('id', $id);
            })
            ->simplePaginate(30);

        $recipes = $recipeHelper->filterPaidRecipes($recipes, $user->isCurrentlySubscribed());


        return RecipeResource::collection($recipes);
    }

    /**
     * Blogs
     * 
     * @authenticated
     * 
     * This endpoint is used to get list of blogs.
     */

    public function blogs(Request $request, BlogHelper $blogHelper)
    {
        $blogs = Blog::with([
            'direct_tags',
            'images',
            'dietician',
            'liked' => fn ($q) => $q->where('liker_id', $request->user()->id),
        ])->simplePaginate(30);



        $blogs = $blogHelper->filterPaidBlogs($blogs, $request->user()->isCurrentlySubscribed());


        return BlogResource::collection($blogs);
    }

    /** 
     * Testimonials
     * 
     * @authenticated
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
     * @authenticated
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
     * @authenticated
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
     * @authenticated
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



    /**
     * Generate Agora Token
     * 
     * This used to generate agora token
     */

    public function getAgoraToken(Request $request)
    {
        $request->validate([
            'channel_name' => 'required|string',
            'uid' => 'required',
        ]);
        $appId = "79d76d9627dc428c801d77502a9cc47f";
        $appCertificate = "988cebdf444c4469b2546c0beecdafa6";
        $channelName = $request->channel_name;
        $uid = $request->uid;
        $uidStr = "$request->uid";
        $tokenExpirationInSeconds = 3600;
        $privilegeExpirationInSeconds = 3600;
        $token = RtcTokenBuilder::buildTokenWithUid($appId, $appCertificate, $channelName, $uid, RtcTokenBuilder::ROLE_PUBLISHER, $tokenExpirationInSeconds, $privilegeExpirationInSeconds);
        return response()->json(['token' => $token]);
    }
}
