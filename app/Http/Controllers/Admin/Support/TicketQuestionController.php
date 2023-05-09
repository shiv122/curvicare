<?php

namespace App\Http\Controllers\Admin\Support;

use App\DataTables\Support\TicketQuestionDataTable;
use App\Http\Controllers\Controller;
use App\Models\TicketQuestion;
use Illuminate\Http\Request;

class TicketQuestionController extends Controller
{


    public function index(TicketQuestionDataTable $table)
    {
        $pageConfigs = ['has_table' => true];
        return $table->render('content.tables.support.ticket-question', compact('pageConfigs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:5000',
        ]);

        TicketQuestion::create([
            'question' =>  $request->question
        ]);

        return response()->json([
            'message' => 'Ticket Question added successfully',
            'table' => 'ticket-question-table'
        ]);
    }

    public function edit($id)
    {
        return TicketQuestion::findOrFail($id);
    }


    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'question' => 'required|string|max:5000'
        ]);

        TicketQuestion::where('id', $request->id)
            ->update([
                'question' => $request->question
            ]);

        return response()->json([
            'message' => 'Ticket Question updated successfully',
            'table' => 'ticket-question-table'
        ]);
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:ticket_questions,id',
            'status' => 'required|in:active,blocked'
        ]);

        TicketQuestion::where('id', $request->id)->update([
            'status' => ($request->status === 'active') ? 'active' : 'inactive'
        ]);

        return response(['message' => 'Status changed successfully', 'header' => 'Changed']);
    }
}
