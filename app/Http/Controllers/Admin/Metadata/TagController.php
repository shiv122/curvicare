<?php

namespace App\Http\Controllers\Admin\Metadata;

use App\DataTables\TagDataTable;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(TagDataTable $table)
    {
        $pageConfigs = ['has_table' => true];
        return $table->render('content.tables.metadata.tags', compact('pageConfigs'));
    }

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
            'table' => 'tag-table'
        ]);
    }

    public function edit($id)
    {
        return response(Tag::findOrFail($id));
    }


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags,name,' . $request->id
        ]);
        Tag::findOrFail($request->id)->update([
            'name' => $request->name
        ]);
        return response([
            'header' => 'Updated',
            'message' => 'Tag updated successfully',
            'table' => 'tag-table'
        ]);
    }




    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:tags,id',
            'status' => 'required|in:active,blocked'
        ]);

        Tag::find($request->id)->update([
            'status' => $request->status
        ]);

        return response(['status' => 'success', 'header' => 'Updated', 'message' => 'Tag\'s status updated successfully']);
    }
}
