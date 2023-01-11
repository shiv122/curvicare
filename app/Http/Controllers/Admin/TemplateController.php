<?php

namespace App\Http\Controllers\Admin;

use App\Models\Recipe;
use App\Models\Template;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\TemplateDataTable;
use App\Helpers\RecipeHelper;
use App\Models\TemplateRecipe;

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


    public function assignPage()
    {
        $templates = Template::active()->get();
        $recipes = Recipe::active()->get();
        $pageConfigs = ['has_table' => true];


        return view('content.forms.assign-recipe', compact('pageConfigs', 'templates', 'recipes'));
    }




    public function getAssignments(Request $request, RecipeHelper $helper)
    {

        $request->validate([
            'template_id' => 'required|integer',
        ]);

        $template = Template::findOrFail($request->template_id);

        $assignments = $template->template_recipes()->with(['recipe'])->get();

        [$breakfast, $lunch, $dinner, $snacks] = $helper->getAssignmentsByMeal($assignments);

        return response()->json([
            'breakfast' => view('components.Recipe.recipe-list', ['recipes' => $breakfast])->render(),
            'lunch' => view('components.Recipe.recipe-list', ['recipes' => $lunch])->render(),
            'dinner' => view('components.Recipe.recipe-list', ['recipes' => $dinner])->render(),
            'snacks' => view('components.Recipe.recipe-list', ['recipes' => $snacks])->render(),
        ]);
    }


    public function assignRecipe(Request $request)
    {
        $request->validate([
            'template' => 'required|integer|exists:templates,id',
            'recipes' => 'required|array',
            'recipes.*' => 'required|integer|exists:recipes,id',
            'for' => 'required|in:breakfast,lunch,dinner,snacks',
        ]);

        foreach ($request->recipes as $key => $recipe) {
            TemplateRecipe::updateOrCreate([
                'template_id' => $request->template,
                'recipe_id' => $recipe,
                'for' => $request->for,
            ]);
        }


        return response()->json([
            'header' => 'Success',
            'message' => 'Recipe assigned successfully',
            'status' => 'success',
        ]);
    }
}
