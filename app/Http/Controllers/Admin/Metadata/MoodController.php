<?php

namespace App\Http\Controllers\Admin\Metadata;

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
        return $table->render('content.tables.metadata.moods', compact('pageConfigs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|max:255',
        ]);

        Mood::create([
            'name' => $request->name,
        ]);

        return response([
            'header' => 'Created',
            'message' => 'Mood created successfully',
            'table' => 'mood-table'
        ]);
    }

    public function edit($id)
    {
        $mood = Mood::findOrFail($id);
        return response($mood);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'string|max:255|unique:moods,name,' . $request->id,
            'id' => 'required|exists:moods,id'
        ]);
        Mood::find($request->id)->update([
            'name' => $request->name,
        ]);
        return response([
            'header' => 'Updated',
            'message' => 'Mood updated successfully',
            'table' => 'mood-table'
        ]);
    }

    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:moods,id',
            'status' => 'required|in:active,blocked'
        ]);

        Mood::where('id', $request->id)->update([
            'status' => $request->status
        ]);

        return response(['message' => 'Status changed successfully', 'header' => 'Changed']);
    }
}
