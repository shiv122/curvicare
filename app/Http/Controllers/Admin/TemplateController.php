<?php

namespace App\Http\Controllers\Admin;

use App\Models\Recipe;
use App\Models\Template;
use Illuminate\Http\Request;
use App\Helpers\RecipeHelper;
use App\Models\TemplateRecipe;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\DataTables\TemplateDataTable;

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
            'type' => 'required|in:daily,weekly,monthly',
            'days' => [
                'required', 'integer',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->type == 'weekly' && $value % 7 != 0) {
                        $fail('Days should be divisible by 7');
                    }
                },

            ],
        ]);

        Template::create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'days' => $request->days,
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
            'type' => 'required|in:daily,weekly,monthly',
            'days' => [
                'required', 'integer',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->type == 'weekly' && $value % 7 != 0) {
                        $fail('Days should be divisible by 7 if type is weekly');
                    }
                },

            ],
        ]);

        Template::findOrFail($request->id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'days' => $request->days,
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


    public function getDays(Request $request)
    {
        $request->validate([
            'template_id' => 'required|integer',
        ]);

        $template = Template::findOrFail($request->template_id);

        $selector_html = view('components.helper.radio-box', [
            'name' => $template->type,
            'text' => ucfirst(($template->type == 'weekly') ? 'Week' : 'Day'),
            'count' => ($template->type == 'weekly') ? $template->days / 7 : $template->days,
        ])->render();

        return response()->json([
            'selector_html' => $selector_html,
        ]);
    }


    public function getAssignments(Request $request, RecipeHelper $helper)
    {

        $request->validate([
            'template_id' => 'required|integer',
            'day' => 'required|integer',
        ]);

        $template = Template::findOrFail($request->template_id);


        DB::beginTransaction();
        DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
        $assignments = $template->template_recipes()
            ->when($template->type == 'weekly', function ($query) use ($request) {
                $start_day = ($request->day - 1) * 7 + 1;
                $end_day = $request->day * 7;
                return $query->whereBetween('day', [$start_day, $end_day])
                    ->groupBy('recipe_id', 'for');
            })
            ->when($template->type == 'daily', function ($query) use ($request) {
                return $query->where('day', $request->day);
            })
            ->with(['recipe'])->get();
        DB::statement("SET sql_mode=(SELECT CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY'));");
        DB::commit();


        $arr = [
            'early_morning',
            'breakfast',
            'mid_morning',
            'pre_lunch',
            'lunch',
            'post_lunch',
            'evening_snack',
            'pre_dinner',
            'dinner',
            'post_dinner',
            'pre_workout',
            'post_workout'
        ];


        foreach ($arr as $key => $value) {
            ${$value} = $helper->getAssignmentsByMeal($assignments, $value);
        }

        $res = [];
        $html = '';

        foreach ($arr as $key => $value) {
            $rendered_html = view('components.Recipe.recipe-list', ['assignments' => ${$value}])->render();
            $html .= '<div class="col-12 text-center"><h4>' . ucfirst(str_replace('_', ' ', $value)) . '</h4></div>';
            $html .= $rendered_html;
            $res[$value] =  $rendered_html;
        }
        $res['all_list'] =  $html;
        return response()->json($res);
    }


    public function assignRecipe(Request $request)
    {
        $request->validate([
            'template' => 'required|integer',
            'day' => 'required|integer|gt:0',
            'recipe' => 'string',
            'for' => 'required|in:early_morning,breakfast,mid_morning,pre_lunch,lunch,post_lunch,pre_snack,evening_snack,post_snack,pre_dinner,dinner,post_dinner,pre_workout,post_workout',
        ]);

        $template = Template::findOrFail($request->template);

        $days = [];

        if ($template->type == 'weekly') {
            $start_day = ($request->day - 1) * 7 + 1;
            $end_day = $request->day * 7;
            $days = range($start_day, $end_day);
        } else {
            $days = [$request->day];
        }

        foreach ($days as $day) {
            TemplateRecipe::updateOrCreate([
                'template_id' => $template->id,
                'extra' => $request->recipe,
                'day' => $day,
                'for' => $request->for,
            ]);
        }



        return response()->json([
            'header' => 'Success',
            'message' => 'Recipe assigned successfully',
            'status' => 'success',
        ]);
    }


    public function deleteAssignRecipe($id)
    {


        $template_recipe = TemplateRecipe::findOrFail($id);
        $template = $template_recipe->template;

        if ($template->type == 'weekly') {

            TemplateRecipe::where('template_id', $template_recipe->template_id)
                ->where('recipe_id', $template_recipe->recipe_id)
                ->where('for', $template_recipe->for)
                ->delete();
        } else {
            $template_recipe->delete();
        }



        return response()->json([
            'header' => 'Success',
            'message' => 'Recipe unassigned successfully',
            'status' => 'success',
        ]);
    }


    public function updateAssignedRecipe(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'details' => 'nullable|string|max:20000'
        ]);


        $recipe = TemplateRecipe::findOrFail($request->id);


        TemplateRecipe::where('template_id', $recipe->template_id)
            ->where('for', $recipe->for)
            ->update([
                'extra' => $request->details
            ]);

        return response([
            'status' => 'success',
            'message' => 'Template Updated'
        ]);
    }
}
