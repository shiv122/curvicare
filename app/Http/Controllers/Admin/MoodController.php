<?php

namespace App\Http\Controllers\Admin;

use App\Models\Mood;
use Illuminate\Http\Request;
use App\DataTables\MoodDataTable;
use App\Http\Controllers\Controller;

class MoodController extends Controller
{
    public function index(MoodDataTable $table)
    {
        $pageConfigs = ['has_table' => true, 'has_sweetAlert' => true];
        //for filter use with
        // $table->with('id', 1);
        return $table->render('content.tables.moods', compact('pageConfigs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|max:255',
        ]);

        Mood::create([
            'name' => $request->name,
        ]);

        return response(['status' => 'success', 'header' => 'Created', 'message' => 'Mood created successfully', 'name' => 'mood-table']);
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:moods,id',
            'status' => 'required|in:0,1'
        ]);

        Mood::where('id', $request->id)->update([
            'status' => ($request->status == '0') ? 'inactive' : 'active'
        ]);

        return response(['message' => 'Status changed successfully', 'header' => 'Changed']);
    }
}
