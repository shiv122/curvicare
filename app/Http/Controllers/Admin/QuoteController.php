<?php

namespace App\Http\Controllers\Admin;

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
        return $table->render('content.tables.quotes', compact('pageConfigs', 'moods'));
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
            'name' => 'quote-table',
        ]);
    }
}
