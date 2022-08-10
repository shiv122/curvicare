<?php

namespace App\Http\Controllers\Admin\Metadata;

use App\Models\Mood;
use App\Models\MoodQuote;
use Illuminate\Http\Request;
use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\DataTables\MoodQuoteDataTable;

class QuoteController extends Controller
{
    public function index(MoodQuoteDataTable $table)
    {
        $pageConfigs = ['has_table' => true];
        $moods = Mood::active()->get();
        return $table->render('content.tables.metadata.quotes', compact('pageConfigs', 'moods'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'moods.*' => 'required|exists:moods,id',
            'quote' => 'required|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = FileUploader::uploadFile($request->file('image'), 'images/quotes');
        $data = [];
        foreach ($request->moods as  $mood) {
            $data[] = [
                'mood_id' => $mood,
                'quotes' => $request->quote,
                'image' => $image,
                'created_at' => now(),
            ];
        }

        MoodQuote::insert($data);

        return response([
            'message' => 'Quote added successfully',
            'status' => 'success',
            'header' => 'Created',
            'table' => 'quote-table',
        ]);
    }

    public function edit($id)
    {
        $quote = MoodQuote::findOrFail($id);
        return response($quote);
    }

    public function update(Request $request)
    {
        $request->validate([
            'mood' => 'required|exists:moods,id',
            'quote' => 'required|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id' => 'required|exists:mood_quotes,id'
        ]);
        $quote = MoodQuote::find($request->id);
        $image = null;
        if ($request->image) {
            $image = FileUploader::uploadFile($request->file('image'), 'images/quotes');
            unlink($quote->image);
        }
        $quote->quotes = $request->quote;
        $quote->mood_id = $request->mood;
        if ($image) {
            $quote->image = $image;
        }
        $quote->save();
        return response([
            'message' => 'Quote updated successfully',
            'header' => 'Updated',
            'table' => 'quote-table',
        ]);
    }
}
