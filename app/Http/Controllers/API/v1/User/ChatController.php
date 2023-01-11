<?php

namespace App\Http\Controllers\API\v1\User;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use Illuminate\Support\Facades\DB;
use App\Events\Dietician\BasicEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\Chat\ChatResources;
use App\Events\Dietician\BasicDieticianEvent;
use App\Http\Resources\Chat\MessageResources;



/**
 * @group User Chat
 * 
 * APIs for User Chat
 */


class ChatController extends Controller
{



    /**
     * 
     * Get Active Chat
     * 
     * @authenticated
     * 
     * @response 200 {"data":[{"id":1,"message":"Hiii chetan","user_id":2,"dietician":null,"media":[{"id":1,"type":"image","data":"{\"image\": [\"uploads\/image\/image-685694294ff402b988c53fc346e19d5fb5f62f88e24.jpg\", \"uploads\/image\/image-176694294ff402b988c53fc346e19d5fb5f62f88e24.jpg\"]}","created_at":"2022-12-30T05:38:58.000000Z"}],"reply":null,"created_at":"2022-12-30T05:38:58.000000Z"},{"id":2,"message":"Hello ","user_id":null,"dietician":{"id":3,"name":"Chetan Chadam","image":"images\/dietician\/img-516396d609d62ae537360a10547ba805bd7895a7b2.png"},"media":[],"reply":{"id":1,"message":"Hiii chetan","user_id":2,"media":[{"id":1,"type":"image","data":"{\"image\": [\"uploads\/image\/image-685694294ff402b988c53fc346e19d5fb5f62f88e24.jpg\", \"uploads\/image\/image-176694294ff402b988c53fc346e19d5fb5f62f88e24.jpg\"]}","created_at":"2022-12-30T05:38:58.000000Z"}],"created_at":"2022-12-30T05:38:58.000000Z"},"created_at":"2022-12-30T05:38:58.000000Z"}],"links":{"first":"http:\/\/127.0.0.1:9000\/api\/v1\/user\/chat\/active?page=1","last":null,"prev":null,"next":null},"meta":{"current_page":1,"from":1,"path":"http:\/\/127.0.0.1:9000\/api\/v1\/user\/chat\/active","per_page":15,"to":2}}
     * 
     */


    public function activeChat(Request $request)
    {
        $user = $request->user();
        $chat = $user->chats()
            ->whereHas('assignment', function ($query) {
                $query->where('expiry', '>=', now());
            })
            ->latest()
            ->first();

        if (!$chat) {
            return response()->json([
                'message' => 'No active chat found',
            ], 404);
        }


        $messages = $chat->messages()
            ->with([
                'media',
                'reply' => ['media'],
                'dietician:id,name,image'
            ])
            ->latest()
            ->simplePaginate();

        return MessageResources::collection($messages);
    }


    /**
     * Send Message
     * 
     * @authenticated
     *  
     * This endpoint is used to send message to dietician
     * 
     * 
     */

    public function sendMessage(Request $request, FileUploader $uploader)
    {
        $request->validate([
            'message' => 'required_without:media|string|max:3000',
            'media' => 'required_without:message|array',
            'media.*' => 'required_without:message|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,ogg,webm,mp3,wav,flac,avi,wmv,mpg,mpeg,3gp,3g2,m4v,pdf|max:2048',
            'reply_to' => 'nullable|exists:messages,id',
        ]);

        $user = $request->user();

        $chat = $user->chats()
            ->whereHas('assignment', function ($query) {
                $query->where('expiry', '>=', now());
            })
            ->with(['dietician' => fn ($q) => $q->select('dieticians.id', 'dieticians.name', 'dieticians.image')])
            ->first();

        if (!$chat) {
            return response()->json([
                'message' => 'No active chat found',
            ], 404);
        }
        DB::beginTransaction();
        $message = $chat->messages()->create([
            'message' => $request->message,
            'user_id' => $user->id,
            'reply_to' => $request->reply_to,
        ]);

        $media = null;
        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $key => $file) {
                $type = $file->getMimeType();
                $type = explode('/', $type)[0];
                $files[$type][$key] = $uploader->upload($file, 'uploads/' . $type, $type);
            }
            $media =   $message->media()->create([
                'message_id' => $message->id,
                'media_data' => json_encode($files),
                'media_type' => $type,
                'created_at' => now(),
            ]);
        }
        DB::commit();

        if ($media) {
            $data = $message->load(['media']);
        } else {
            $data = $message;
        }

        broadcast(new BasicEvent(
            dietician_id: $chat->dietician->id,
            from: $user,
            data: $data->toArray(),
            event: 'message',
        ));

        return response()->json([
            'message' => 'Message sent successfully',
            'data' => $data,
        ], 200);
    }




    public function markRead(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
        ]);

        $user = $request->user();


        $user->messages()
            ->where('chat_id', $request->chat_id)
            ->where('read_at', null)
            ->update([
                'read_at' => now(),
            ]);

        return response()->json([
            'message' => 'Message marked as read',
        ], 200);
    }
}
