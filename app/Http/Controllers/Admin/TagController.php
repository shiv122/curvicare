<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TagDataTable;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags,name'
        ]);
        Tag::create([
            'name' => $request->name
        ]);

        return response([
            'header' => 'Added',
            'message' => 'Tag created successfully',
            'name' => 'tag-table'
        ]);
    }
    public function view(TagDataTable $table)
    {
        $pageConfigs = ['has_table' => true];
        //for filter use with
        // $table->with('id', 1);
        return $table->render('content.tables.tags', compact('pageConfigs'));
    }
    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tags,id',
            'status' => 'required|in:0,1'
        ]);
        $status = ['inactive', 'active'];
        Tag::find($request->id)->update([
            'status' => $status[$request->status]
        ]);

        return response(['status' => 'success', 'header' => 'Updated', 'message' => 'Tag\'s status updated successfully']);
    }
}
