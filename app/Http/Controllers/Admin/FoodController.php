<?php

namespace App\Http\Controllers\Admin;

use App\Models\Food;
use App\Models\FoodImage;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\Models\FoodIngredient;
use App\DataTables\FoodDataTable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class FoodController extends Controller
{
    public function add()
    {
        $ingredients = Ingredient::active()->get();
        return view('content.forms.add-food', compact('ingredients'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:food,name',
            'ingredient_name.*' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|array',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        return   DB::transaction(function () use ($request) {
            $food  = Food::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            $food_ingredients = [];
            foreach ($request->ingredient_name as $key => $ingredient_name) {
                $food_ingredients[] = [
                    'food_id' => $food->id,
                    'ingredient_id' => $ingredient_name,
                    'quantity' => $request->ingredients[$key]['quantity'],
                    'unit' => $request->ingredients[$key]['unit'],
                    'created_at' => now(),
                ];
            }
            $images = [];
            foreach ($request->images as $image) {
                $images[] = [
                    'food_id' => $food->id,
                    'image' => FileUploader::uploadFile($image, 'images/foods'),
                    'created_at' => now(),
                ];
            }

            FoodIngredient::insert($food_ingredients);
            FoodImage::insert($images);

            return response([
                'message' => 'Food added successfully',
                'header' => 'Added',
                'reload' => true,
            ]);
        });
    }
    public function view(FoodDataTable $table)
    {
        $pageConfigs = ['has_table' => true];

        //for filter use with
        // $table->with('id', 1);
        return $table->render('content.tables.foods', compact('pageConfigs'));
    }
}
