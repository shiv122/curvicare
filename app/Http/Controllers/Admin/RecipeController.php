<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Tag;
use App\Models\Food;
use App\Models\Recipe;
use App\Models\Nutrient;
use App\Models\RecipeFood;
use App\Models\RecipeTags;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\Models\RecipeComposition;
use App\DataTables\RecipeDataTable;
use App\Http\Controllers\Controller;

class RecipeController extends Controller
{
    public function index(RecipeDataTable $table)
    {
        $pageConfigs = ['has_table' => true];
        // $table->with('id', 4);
        return $table->render('content.tables.recipes', compact('pageConfigs'));
    }
    public function add()
    {
        $foods = Food::select('id', 'name')->get();
        $nutrients = Nutrient::select('id', 'name')->get();
        $tags = Tag::active()->select('id', 'name')->get();
        return view("content.forms.add-recipe", compact('foods', 'nutrients', 'tags'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'foods.*' => 'required|exists:food,id',
            'nutrients.*' => 'required|exists:nutrients,id',
            'tags.*' => 'required|exists:tags,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        DB::transaction(function () use ($request) {
            $recipe = Recipe::create([
                'name' => $request->name,
                'caution' => $request->caution,
                'image' => FileUploader::uploadFile($request->file('image'), 'images/recipes'),
            ]);

            $nutrients = [];
            $foods = [];
            $tags = [];
            foreach ($request->nutrients as $key => $n) {
                $nutrients[] = [
                    'nutrient_id' => $n,
                    'recipe_id' => $recipe->id,
                    'percentage' => $request->composition[$key]['percent'],
                    'created_at' => now(),
                ];
            }
            foreach ($request->foods as $key => $f) {
                $foods[] = [
                    'food_id' => $f,
                    'recipe_id' => $recipe->id,
                    'created_at' => now(),
                ];
            }
            foreach ($request->tags as $key => $t) {
                $tags[] = [
                    'tag_id' => $t,
                    'recipe_id' => $recipe->id,
                    'created_at' => now(),
                ];
            }


            RecipeComposition::insert($nutrients);
            RecipeFood::insert($foods);
            RecipeTags::insert($tags);
        });


        return $request->all();
    }
    public function show($id)
    {
        $recipe = Recipe::where('id', $id)->with(['foods', 'compositions', 'tags'])->first();
        // dd($recipe->toArray());
        return view('content.pages.recipe-details', compact('recipe'));
    }
    public function status()
    {
    }
}
