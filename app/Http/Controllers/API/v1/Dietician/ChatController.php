<?php

namespace App\Http\Controllers\API\v1\Dietician;

use DB;
use Log;
use App\Models\Blog;
use App\Models\Chat;
use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\Events\User\BasicUserEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Http\Resources\Chat\ChatResources;
use App\Http\Resources\Chat\MessageResources;
use App\Http\Resources\Tracker\UserMoodResource;
use App\Http\Resources\Tracker\UserStepResource;
use App\Http\Resources\Tracker\UserWaterResource;
use App\Http\Resources\WeeklyReportResource;
use App\Models\UserMoodTracker;
use App\Models\UserSleepSchedule;
use App\Models\UserStepCounter;
use App\Models\UserWaterTracker;
use App\Models\WeeklyReport;

/**
 * 
 * @group Dietician Chat
 * 
 * APIs for Dietician Chat
 * 
 * @authenticated
 * 
 */

class ChatController extends Controller
{

    /**
     * Get Active Chats
     * 
     * This endpoint is used to get active chats
     * 
     */

    public function activeChats(Request $request)
    {
        $dietician = $request->user();

        $assignment = $dietician->assignments()
            ->whereHas('assignment', function ($query) {
                $query->where('expiry', '>=', now())
                    ->where('status', 'assigned');
            })
            ->with([
                'chats' => [
                    'messages' => function ($query) {
                        $query->latest()->take(20)
                            ->with(['media', 'reply' => ['media'],]);
                    },

                    'user:id,name,image' => [
                        'user_data' => ['user_goal', 'user_activity'],
                        'subscriptions' => fn ($query) => $query->where('end_date', '>=', now()),
                        'medical_conditions.condition'
                    ]
                ]
            ])
            ->get();

        $chats = $assignment->pluck('chats')->flatten();



        return ChatResources::collection($chats);
    }



    /**
     * Get Messages
     * 
     * This endpoint is used to get messages (with pagination)
     * 
     */

    public function messages(Request $request,  $id)
    {

        $dietician = $request->user();
        $messages =  $dietician->messages()->where('chat_id', $id)->with(['media', 'reply' => ['media'],])->latest()->paginate(20);


        return MessageResources::collection($messages);
    }

    /**
     * Send Message
     * 
     * This endpoint is used to send message
     */

    public function sendMessage(Request $request, FileUploader $uploader)
    {
        $request->validate([
            // message is required if media or recipe_id is not present
            'message' => 'required_without_all:media,recipe_id,blog_id|string|max:3000',
            'media' => 'required_without_all:message,recipe_id,blog_id|array|max:5',
            'media.*' => 'required_without_all:message,recipe_id,blog_id|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,ogg,webm,mp3,wav,flac,avi,wmv,mpg,mpeg,3gp,3g2,m4v,pdf,doc,docx,xls,xlsx,ppt,pptx|max:2048',
            'recipe_id' => 'required_without_all:message,media,blog_id',
            'blog_id' => 'required_without_all:message,media,recipe_id',
            'reply_to' => 'nullable|exists:messages,id',
            'chat_id' => 'required|exists:chats,id',
        ]);

        $dietician = $request->user();

        $chat = $dietician->chats()
            ->whereHas('assignment', function ($query) {
                $query->where('expiry', '>=', now());
            })
            ->where('chats.id', $request->chat_id)
            ->first();


        if (!$chat) {
            return response()->json([
                'message' => 'No active chat found',
            ], 404);
        }

        DB::beginTransaction();

        $message = $chat->messages()->create([
            'message' => $request->message,
            'dietician_id' => $dietician->id,
            'reply_to' => $request->reply_to,
        ]);
        $media = null;
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $key => $file) {
                $type = $file->getMimeType();
                \Log::info($type);
                $type = explode('/', $type)[0];
                if ($type === 'application') {
                    $type = $file->getClientOriginalExtension();
                }
                $files[$type][$key] = $uploader->upload($file, 'uploads/' . $type, $type);
            }
            $media[] =  $message->media()->create([
                'message_id' => $message->id,
                'media_data' => json_encode($files),
                'media_type' => $type,
                'created_at' => now(),
            ]);
        }

        if ($request->recipe_id) {
            $recipe = Recipe::with([
                'foods' => ['ingredients', 'images'],
                'compositions',
                'tags',
            ])
                ->findOrFail($request->recipe_id);

            $recipe = new RecipeResource($recipe);

            $media[] = $message->media()->create([
                'message_id' => $message->id,
                'media_data' => json_encode($recipe),
                'media_type' => 'recipe',
                'created_at' => now(),
            ]);
        }

        if ($request->blog_id) {
            $blog = Blog::with([
                'direct_tags',
                'images',
                'dietician'
            ])
                ->findOrFail($request->blog_id);

            $media[] = $message->media()->create([
                'message_id' => $message->id,
                'media_data' => json_encode($blog),
                'media_type' => 'blog',
                'created_at' => now(),
            ]);
        }

        DB::commit();

        $message->media = $media;

        broadcast(new BasicUserEvent(
            user_id: $chat->user_id,
            from: $dietician->only(['id', 'name', 'image']),
            data: $message->toArray(),
            event: 'message',
        ));


        if ($media) {
            $message =  $message->load(['media']);
        }


        return response()->json([
            'message' => 'Message sent successfully',
            'data' => new MessageResources($message)
        ]);
    }



    /**
     * Weekly Report By User
     */



    public function weeklyReport($user)
    {
        $report = WeeklyReport::where('user_id', $user)->get();

        return WeeklyReportResource::collection($report);
    }


    public function trackerReport($user)
    {
        $mood = UserMoodTracker::where('user_id', $user)
            // ->where('created_at', '>=', now()->subMonth(2))
            ->with(['user', 'mood'])->get();
        $step = UserStepCounter::where('user_id', $user)
            // ->where('created_at', '>=', now()->subMonth(2))
            ->with('user')->get();
        $water = UserWaterTracker::where('user_id', $user)
            // ->where('created_at', '>=', now()->subMonth(2))
            ->with('user')->get();

        return response([
            'mood' => UserMoodResource::collection($mood),
            'step' => UserStepResource::collection($step),
            'water' => UserWaterResource::collection($water),
        ]);
    }
}
