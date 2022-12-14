<?php

namespace App\Http\Controllers\Admin\Metadata;

use App\Models\Expertise;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\DataTables\ExpertiseDataTable;

class ExpertiseController extends Controller
{
    public function index(ExpertiseDataTable $table)
    {
        $pageConfigs = ['has_table' => true];
        return $table->render('content.tables.metadata.expertise', compact('pageConfigs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:expertises,name|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:50',
        ]);

        $expertise = new Expertise();
        $expertise->name = $request->name;
        $expertise->slug = Str::slug($request->name);
        if ($request->hasFile('icon')) {
            $expertise->icon = FileUploader::uploadFile($request->file('icon'), 'images/expertise', 'icon');
        }
        $expertise->save();

        return response()->json([
            'message' => 'Expertise added successfully',
            'table' => 'expertise-table'
        ]);
    }

    public function edit($id)
    {
        $expertise = Expertise::find($id);
        return response()->json($expertise);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:50',
            'id' => 'required|exists:expertises,id'
        ]);

        $expertise = Expertise::find($request->id);
        $expertise->name = $request->name;
        $expertise->slug = Str::slug($request->name);
        if ($request->hasFile('icon')) {
            $expertise->icon = FileUploader::uploadFile($request->file('icon'), 'images/expertise', 'icon');
        }
        $expertise->save();

        return response()->json([
            'message' => 'Expertise updated successfully',
            'table' => 'expertise-table'
        ]);
    }

    public function destroy($id)
    {
        $expertise = Expertise::findOrFail($id);
        $expertise->delete();

        return response()->json([
            'message' => 'Expertise deleted successfully',
            'table' => 'expertise-table'
        ]);
    }
}
