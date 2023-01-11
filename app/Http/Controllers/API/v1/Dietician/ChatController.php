<?php

namespace App\Http\Controllers\API\v1\Dietician;

use App\Models\Chat;
use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\Events\User\BasicUserEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Http\Resources\Chat\ChatResources;
use App\Http\Resources\Chat\MessageResources;
use DB;
use Log;

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

                    'user:id,name,image'
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
            'message' => 'required_without_all:media,recipe_id|string|max:3000',
            'media' => 'required_without_all:message,recipe_id|array|max:5',
            'media.*' => 'required_without_all:message,recipe_id|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,ogg,webm,mp3,wav,flac,avi,wmv,mpg,mpeg,3gp,3g2,m4v,pdf|max:2048',
            'recipe_id' => 'required_without_all:message,media|exists:recipes,id',
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
                $type = explode('/', $type)[0];
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
                ->find($request->recipe_id);

            $recipe = new RecipeResource($recipe);

            $media[] = $message->media()->create([
                'message_id' => $message->id,
                'media_data' => json_encode($recipe),
                'media_type' => 'recipe',
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
}
