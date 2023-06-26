<?php

namespace App\Http\Controllers\API\v1\Dietician;

use App\Models\Blog;
use App\Models\Recipe;
use App\Models\Template;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Services\Agora\RtcTokenBuilder;
use App\Http\Resources\TemplateResource;
use App\Http\Resources\Misc\BlogResource;
use App\Services\Dietician\FormatDietService;

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
     * You can also get single template by id
     * if id is not provided, all templates will be returned
     * if id is provided, single template will be returned with its recipes
     */

    public function templates(FormatDietService $service, $id = null)
    {

        $templates =  Template::active()
            ->when($id, function ($query) use ($id) {
                $query->where('id', $id)
                    ->with(['recipes' => [
                        'foods' => ['ingredients', 'images'],
                        'compositions',
                        'tags'
                    ]]);
            })
            ->get();

        if (!$id) {
            return TemplateResource::collection($templates);
        }

        return $templates->map(function ($template) use ($service) {
            $template->data = $service->format($template);
            unset($template->recipes);
            return $template;
        });
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


    /**
     * Get Blogs
     * 
     * This endpoint is used to get blogs (paginated)
     * 
     */



    public function blogs()
    {
        $blogs = Blog::with([
            'direct_tags',
            'images',
            'dietician',
        ])->simplePaginate(30);

        return BlogResource::collection($blogs);
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
