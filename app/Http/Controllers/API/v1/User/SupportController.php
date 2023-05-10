<?php

namespace App\Http\Controllers\API\v1\User;

use Str;
use App\Models\SupportChat;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\Models\TicketQuestion;
use App\Http\Controllers\Controller;
use App\Http\Resources\Support\TicketResource;
use App\Http\Resources\Support\SupportChatResource;
use App\Http\Resources\Support\TicketQuestionResource;


/**
 * @group User Support
 * 
 * APIs for Ticket/Chat support
 *  @authenticated
 */


class SupportController extends Controller
{


    /**
     * 
     * Get Question 
     * 
     * This api will return predefined question of tickets
     * @authenticated 
     */

    public function getQuestions()
    {
        $questions = TicketQuestion::active()->get();

        return TicketQuestionResource::collection($questions);
    }

    /**
     * 
     * Get Tickets 
     * 
     * This api will return Ticket raised by user
     * @authenticated 
     */


    public function getTickets(Request $request)
    {
        $user = $request->user();

        $tickets = $user->tickets->load(['question']);

        return TicketResource::collection($tickets);
    }
    /**
     * 
     * Raise Ticket
     * 
     * This api will create a ticket
     * @authenticated 
     */


    public function raiseTicket(Request $request)
    {
        $request->validate([
            'question_id' => 'required|numeric',
            'description' => 'required|string|max:5000'
        ]);

        $user = $request->user();

        $user->tickets()->create([
            'ticket_question_id' => $request->question_id,
            'ticket_no' => Str::uuid(),
            'description' => $request->description,
        ]);

        return response([
            'status' => 'success',
            'message' => 'ticket raised successfully'
        ]);
    }

    /**
     * 
     * Get Chat
     * 
     * This api will return message from user and support
     * @authenticated 
     */

    public function getChat(Request $request)
    {
        $user = $request->user();

        $chats = SupportChat::where('user_id', $user->id)->simplePaginate(40);

        return SupportChatResource::collection($chats);
    }

    /**
     * 
     * Send Message
     * 
     * This api will send message to support
     * @authenticated 
     */
    public function sendMessage(Request $request, FileUploader $uploader)
    {
        $request->validate([
            'message' => 'required_without:file|max:2000|string',
            'file' => 'required_without:message|max:2048|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $user =  $request->user();

        $user->support_chats()->create([
            'message' => $request->message,
            'file' => ($request->has('file')) ? $uploader->uploadFile($request->file, 'image/support') : null,
            'from' => 'user'
        ]);

        return response([
            'status' => 'success',
            'message' => 'message send successfully'
        ]);
    }
}
