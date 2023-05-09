<?php

namespace App\Http\Controllers\Admin\Support;

use App\DataTables\Support\TicketDataTable;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(TicketDataTable $table)
    {
        $pageConfigs = ['has_table' => true];
        return $table->render('content.tables.support.ticket', compact('pageConfigs'));
    }


    public function reply(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'reply' => 'string|required|max:5000',
            'status' => 'string|in:pending,in_process,resolved'
        ]);

        Ticket::where('id', $request->id)
            ->update([
                'reply' => $request->reply,
                'status' => $request->status
            ]);


        return response()->json([
            'message' => 'Replied successfully',
            'table' => 'ticket-table'
        ]);
    }
}
