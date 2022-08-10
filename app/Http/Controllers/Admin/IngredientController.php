<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\BaseIngredient;
use App\Http\Controllers\Controller;
use App\DataTables\IngredientDataTable;
use App\Helpers\FileUploader;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    public function index(IngredientDataTable $table)
    {
        $pageConfigs = ['has_table' => true];
        $baseIngredient = BaseIngredient::active()->get();
        return $table->render('content.tables.ingredients', compact('pageConfigs', 'baseIngredient'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:ingredients',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'caution' => 'nullable|string',
        ]);

        $name =  $this->manageBaseIngredients($request);

        $image = FileUploader::uploadFile($request->file('image'), 'images/ingredients');

        $ingredient = Ingredient::create([
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
            'caution' => $request->caution,
        ]);

        return response([
            'header' => 'Success',
            'message' => 'Ingredient added successfully.',
            'table' => 'ingredient-table',
            'new_ingredient' => $name
        ], 200);
    }
    public function status()
    {
    }

    public function manageBaseIngredients(Request $request): bool|string
    {
        $exists = BaseIngredient::where('name', $request->name)->exists();
        if (!$exists) {
            BaseIngredient::create([
                'name' => $request->name,
            ]);
            return $request->name;
        }
        return false;
    }
}
