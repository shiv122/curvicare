<?php

namespace App\Http\Controllers\Admin;

use App\Models\FaqCategory;
use Illuminate\Http\Request;
use App\DataTables\FaqDataTable;
use App\Http\Controllers\Controller;
use App\DataTables\FaqCategoryDataTable;
use App\Models\Faq;

class FaqController extends Controller
{


    public function index(FaqDataTable $table)
    {
        $pageConfigs = ['has_table' => true];
        $faq_cats = FaqCategory::active()->get();
        return $table->render('content.tables.faqs', compact('pageConfigs', 'faq_cats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:2000',
            'answer' => 'required|string|max:5000',
        ]);

        Faq::create([
            'faq_category_id' => $request->category,
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return response()->json([
            'success' => 'Faq created successfully',
            'table' => 'faq-table',
        ]);
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return response()->json($faq);
    }

    public function update(Request $request)
    {
        $request->validate([
            'category' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:2000',
            'answer' => 'required|string|max:5000',
            'id' => 'required|numeric',
        ]);

        $faq = Faq::findOrFail($request->id);
        $faq->update([
            'faq_category_id' => $request->category,
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Faq updated successfully',
            'table' => 'faq-table',
        ]);
    }


    public function status(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'status' => 'required|in:active,blocked',
        ]);

        $faq = Faq::findOrFail($request->id);
        $faq->update([
            'status' => ($request->status == 'active') ? $request->status : 'inactive',
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Faq status updated successfully',
            'table' => 'faq-table',
        ]);
    }


    public function statusIsPaid(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'status' => 'required|in:active,blocked',
        ]);

        $faq = Faq::findOrFail($request->id);
        $faq->update([
            'is_paid' => ($request->status == 'active') ? 'yes' : 'no',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Faq paid status updated successfully',
            'table' => 'faq-table',
        ]);
    }
    public function statusIsFeatured(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'status' => 'required|in:active,blocked',
        ]);

        $faq = Faq::findOrFail($request->id);
        $faq->update([
            'is_featured' => ($request->status == 'active') ? 'yes' : 'no',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Faq  Featured status updated successfully',
            'table' => 'faq-table',
        ]);
    }













    /*
    |--------------------------------------------------------------------------
    | Faq  Category section
    |--------------------------------------------------------------------------
    */
    public function faqCategories(FaqCategoryDataTable $table)
    {
        $pageConfigs = ['has_table' => true];
        return $table->render('content.tables.faq-categories', compact('pageConfigs'));
    }


    public function faqCategoriesStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        FaqCategory::create($request->only(['name']));

        return response()->json([
            'success' => true,
            'message' => 'Faq Category created successfully',
            'table' => 'faq-category-table'
        ]);
    }


    public function faqCategoriesEdit($id)
    {
        $cat = FaqCategory::findOrFail($id);

        return response($cat);
    }

    public function faqCategoriesUpdate(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
        ]);

        $cat = FaqCategory::findOrFail($request->id)
            ->update($request->only(['name']));

        return response()->json([
            'success' => true,
            'message' => 'Faq Category updated successfully',
            'table' => 'faq-category-table'
        ]);
    }


    public function faqCategoriesStatus(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'status' => 'required|in:active,blocked',
        ]);

        $cat = FaqCategory::findOrFail($request->id)
            ->update(['status' => ($request->status == 'active') ? 'active' : 'inactive']);

        return response()->json([
            'success' => true,
            'message' => 'Faq Category status updated successfully',
            'table' => 'faq-category-table'
        ]);
    }
}
