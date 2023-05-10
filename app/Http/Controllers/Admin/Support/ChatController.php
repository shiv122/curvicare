<?php

namespace App\Http\Controllers\Admin\Support;

use App\Http\Controllers\Controller;
use App\Models\SupportChat;
use DB;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function index(Request $request)
    {
        $pageConfigs = [
            'pageHeader' => false,
            'contentLayout' => "content-left-sidebar",
            'pageClass' => 'chat-application',
        ];

        $chats =   SupportChat::whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')->from('support_chats')
                ->groupBy('user_id');
        })
            ->orderBy('id', 'desc')
            // ->where('from', 'user')
            ->with([
                'user' => function ($q) {
                    $q->select(DB::raw('(select COUNT(*) from support_chats where user_id = users.id and support_chats.read_by_admin="0" and support_chats.from="user") as unread,id,image,email,phone,name'));
                }
            ])->get();


        if ($request->ajax()) {
            return view('content.ajax-component.support.support-sidebar-users', compact('chats'));
        }


        return view('content.pages.support.chat', compact('pageConfigs', 'chats'));
    }

    public function chatByUser(Request $request)
    {
        $request->validate([
            'user' => 'required',
        ]);

        SupportChat::where('user_id', $request->user)->update([
            "read_by_admin" => 1
        ]);

        $messages = SupportChat::where('user_id', $request->user)
            ->latest('id')
            ->with(['user'])->paginate(15);

        $is_last_page = $messages->currentPage() === $messages->lastPage();

        $messages =  $messages->reverse();

        $messages_html = view('content.ajax-component.support.messages', compact('messages'))->render();

        $user = $messages->first()->user;
        $header_html = view('content.ajax-component.support.user-header', compact('user'))->render();



        return response([
            'header' => $header_html,
            'messages' => $messages_html,
            'is_last_page' => $is_last_page
        ]);
    }



    public function send(Request $request)
    {
        $request->validate([
            'user' => 'required',
            'message' => 'required_without:file|max:2000|string',
            'file' => 'required_without:message|max:2048|image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        SupportChat::create([
            'user_id' => $request->user,
            'message' => $request->message,
            'from' => 'admin'
        ]);

        return response([
            'message' => 'created successfully',

        ]);
    }
}
