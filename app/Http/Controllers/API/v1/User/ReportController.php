<?php

namespace App\Http\Controllers\API\v1\User;

use App\Helpers\FileUploader;
use App\Http\Controllers\Controller;
use App\Http\Resources\WeeklyReportResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * @group User Weekly Report
 * 
 * @authenticated
 * 
 * APIs for User Weekly Report
 */
class ReportController extends Controller
{

    /**
     * Get Weekly Report
     */
    public function index(Request $request)
    {
        $user  = $request->user();

        $reports = $user->weekly_reports()->simplePaginate();

        return WeeklyReportResource::collection($reports);
    }

    /**
     * Submit Weekly Report
     */

    public function submit(Request $request, FileUploader $uploader)
    {
        $request->validate([
            'height' => 'required|numeric',
            'chest' => 'required|numeric',
            'thighs' => 'required|numeric',
            'images' => 'required|array',
            'images.*' => 'required|image|max:6000',
        ]);


        $user = $request->user();

        $past_report = $user->weekly_reports()->latest()->first();

        if ($past_report) {
            if ($past_report->created_at > now()->subDays(7)) {
                return response([
                    'status' => 'error',
                    'message' => 'Already submitted weekly report ' . $past_report->created_at->diffForHumans(),
                ], 400);
            }
        }




        $images = [];

        foreach ($request->images as $img) {
            $images[] = $uploader->upload($img, 'images/weekly-report');
        }

        $user->weekly_reports()->create([
            'data' => json_encode([
                'height' => $request->height,
                'chest' => $request->chest,
                'thighs' => $request->thighs,
                'images' => $images,
            ]),
        ]);

        return response([
            'status' => 'success',
            'message' => 'report created successfully',
        ]);
    }
}
