<?php

namespace App\Http\Controllers\API\v1\Dietician;

use App\Models\Template;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Http\Resources\TemplateResource;
use App\Models\Recipe;

/** 
 * @group Dietician Basic
 *  @authenticated
 */


class BasicController extends Controller
{

    /**
     * Dietician Profile
     * 
     * This endpoint is used to get dietician profile
     * 
     */


    public function profile(Request $request)
    {
        return $request->user('dietician');
    }


    /**
     * Update Dietician Profile
     * 
     * This endpoint is used to update dietician profile
     */


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:512',
            'phone' => 'required|string|size:10',
            'address' => 'required|string|max:3000',
        ]);
        $dietician = $request->user('dietician');
        $dietician->update($request->only(['name', 'phone', 'address']));
        if ($request->hasFile('image')) {
            $dietician->image = FileUploader::uploadFile($request->file('image'), 'images/dieticians', 'dietician');
            $dietician->save();
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Dietician profile updated successfully',
        ]);
    }

    /**
     * Get Templates
     * 
     * This endpoint is used to get templates
     */

    public function templates()
    {

        $templates =  Template::active()->with(['recipes' => [
            'foods' => ['ingredients', 'images'],
            'compositions',
            'tags'
        ]])->get();


        return TemplateResource::collection($templates);
    }


    /**
     * Get Recipes
     * 
     * This endpoint is used to get recipes (paginated)
     * You can also search recipes by name using query parameter q
     * 
     */

    public function recipes(Request $request)
    {
        $request->validate([
            'q' => 'nullable|string|max:255',
        ]);

        $recipes = Recipe::active()
            ->when($request->has('q'), function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->q . '%');
            })
            ->with(['compositions'])
            ->orderBy('name', 'asc')
            ->simplePaginate(20);

        return RecipeResource::collection($recipes);
    }
}
