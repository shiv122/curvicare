<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TemplateDataTable;
use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index(TemplateDataTable $table)
    {
        $pageConfigs = ['has_table' => true];

        return $table->render('content.tables.templates', compact('pageConfigs'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:3000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:512',
        ]);

        Template::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json([
            'header' => 'Success',
            'message' => 'Template created successfully',
            'status' => 'success',
            'table' => 'template-table'
        ]);
    }

    public function edit($id)
    {
        $template = Template::findOrFail($id);
        return response()->json($template);
    }


    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:3000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:512',
            'id' => 'required|integer',
        ]);

        Template::findOrFail($request->id)->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);


        return response()->json([
            'header' => 'Success',
            'message' => 'Template updated successfully',
            'status' => 'success',
            'table' => 'template-table'
        ]);
    }


    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'status' => 'required|in:active,blocked',
        ]);

        Template::findOrFail($request->id)->update([
            'status' => ($request->status === 'active') ? 'active' : 'inactive',
        ]);

        return response()->json([
            'header' => 'Success',
            'message' => 'Template status updated successfully',
            'status' => 'success',
            'table' => 'template-table'
        ]);
    }
}
