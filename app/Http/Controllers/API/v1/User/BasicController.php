<?php

namespace App\Http\Controllers\API\v1\User;

use App\Models\Blog;
use App\Models\Recipe;
use App\Models\MoodQuote;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BasicController extends Controller
{


    public function profile(Request $request)
    {
        $user = $request->user();

        return response()->json($user);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $user = $request->user();

        $user->update($request->only(
            'name',
            'email',
        ));

        return response()->json($user);
    }



    public function quotes(Request $request)
    {
        $quote = MoodQuote::inRandomOrder()->first();
        return response()->json($quote);
    }

    public function recipes()
    {
        $recipes = Recipe::with([
            'foods',
            'compositions',
            'tags',
        ])->get();

        return response()->json($recipes);
    }


    public function blogs()
    {
        $blogs = Blog::with([
            'tags',
            'images',
            'dietician',
        ])->get();


        return response()->json($blogs);
    }

    public function testimonials()
    {
        $testimonials = Testimonial::all();

        return response()->json($testimonials);
    }
}
