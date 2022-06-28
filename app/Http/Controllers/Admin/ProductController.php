<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductDataTable;
use App\Helpers\FileUploader;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function index(ProductDataTable $table)
    {

        // $product = Product::with(['media'])->get();
        // // dd($product);
        // dd($product->pluck('media')->flatten()->pluck('image'));

        $pageConfigs = ['has_table' => true];
        // $table->with('id', 1);
        return $table->render('content.tables.products', compact('pageConfigs'));
    }

    public function add()
    {
        return view('content.forms.add-product');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|url|max:2000',
            'description' => 'nullable|string|max:255',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        return  DB::transaction(function () use ($request) {
            $product = Product::create([
                'name' => $request->name,
                'url' => $request->link,
                'description' => $request->description,
                'status' => 'active',
            ]);

            foreach ($request->images as $image) {
                $product->media()->create([
                    'image' => FileUploader::uploadFile($image, 'images/products'),
                ]);
            }

            return response([
                'message' => 'Product created successfully',
                'header' => 'Created',
                'type' => 'success',
            ]);
        });
    }

    public function status(Request $request)
    {
        $request->validate([
            'status' => 'required|in:0,1',
            'id' => 'required|exists:products,id',
        ]);
        $status = ['inactive', 'active'];
        Product::where('id', $request->id)->update([
            'status' => $status[$request->status],
        ]);

        return response([
            'message' => 'Product status updated successfully',
            'header' => 'Updated',
            'type' => 'success',
        ]);
    }
}
