<?php

namespace App\Services;

use Log;
use Exception;
use App\Models\Chat;
use App\Models\User;
use App\Models\Dietician;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Models\DieticianAssignment;
use App\Jobs\Notification\NotificationJob;

class DieticianAssignmentService
{



    /**
     * Assign dietician to user
     * 
     * This method will assign dietician to user based on the expertise and availability of dietician 
     * using logarithmic algorithm
     * 
     * @param DieticianAssignment $assignment
     * 
     * @return JsonResponse
     * 
     */


    public function assign(DieticianAssignment $assignment): JsonResponse
    {
        $expertise = json_decode($assignment->form_data, true)['expertise'];

        $user = $assignment->user;
        $assignable_dietician = $this->assignableDieticians($expertise);

        if ($assignable_dietician) {
            DB::beginTransaction();
            $assignment->assigned_dieticians()->create([
                'dietician_id' => $assignable_dietician->id,
                'role' => 'dietician',
                'status' => 'assigned',
            ]);
            $assignment->update([
                'status' => 'assigned',
            ]);
            Log::channel('dietician_assignment')->info('=================== Assigned ======================');
            Log::channel('dietician_assignment')->info('Assignment');
            Log::channel('dietician_assignment')->info(json_encode($assignment, true));
            Log::channel('dietician_assignment')->info('Dietician: ' . $assignable_dietician->id);
            Log::channel('dietician_assignment')->info('==================================================');

            $this->initiateChat($assignment, $user);
            DB::commit();
            $this->sendNotification($user, $assignable_dietician);
            return response()->json([
                'message' => 'Dietician assigned successfully',
                'data' => $assignable_dietician,
                'user' => $user,
                'assignment' => $assignment,
            ], 200);
        } else {
            Log::channel('dietician_assignment')->error('=================== Unable to assign ======================');
            Log::channel('dietician_assignment')->error('No dietician found for assignment: ' . $assignment->id);
            Log::channel('dietician_assignment')->error('==========================================================');


            return response()->json([
                'message' => 'No dietician found',
                'status' => 'failed',
            ], 422);
        }
    }



    /**
     * Initiate chat
     * 
     * This method will initiate chat between user and dietician
     * 
     * @param DieticianAssignment $assignment
     * @param User $user
     * 
     * @return void
     * 
     */


    public function initiateChat(
        DieticianAssignment $assignment,
        User $user
    ): void {

        Chat::create([
            'user_id' => $user->id,
            'assigned_dietician_id' => $assignment->assigned_dieticians->first()->id,
            'dietician_assignment_id' => $assignment->id,
            'status' => 'active',
        ]);
    }


    /**
     * Return assignable dietician
     * 
     * This method will return assignable dietician based on the expertise and availability of dietician
     * 
     * @param array $expertise
     * 
     * @return Object
     */

    public function assignableDieticians(array $expertise)
    {
        $dieticians = Dietician::whereHas('expertise', function ($query) use ($expertise) {
            $query->whereIn('expertise_id', $expertise);
        })
            ->with(['expertise'])
            ->with([
                'assignments' => function ($query) {
                    $query->whereHas('assignment', function ($query) {
                        $query->where('expiry', '>=', now());
                    });
                }
            ])
            ->get();
        $dieticians = $dieticians->filter(function ($dietician) use ($expertise) {
            $dietician->number_of_matching_expertise = $dietician->expertise->whereIn('expertise_id', $expertise)->count();
            $dietician->number_of_assignments = $dietician->assignments->count();
            $dietician->matching_probability = $this->calculateAssignmentProbability($dietician->number_of_matching_expertise, $dietician->number_of_assignments);
            return $dietician->assignments->count() < 10;
        });
        $dieticians = $dieticians->sortBy('number_of_assignments');
        $dietician = $dieticians->sortByDesc('matching_probability')->first();
        return $dietician;
    }



    /**
     * Calculate assignment probability
     * 
     * This method will calculate assignment probability based on the number of matching expertise and number of assignments
     * 
     * @param int $number_of_matching_expertise
     * @param int $number_of_assignments
     * 
     * @return float
     */

    public function calculateAssignmentProbability(
        $number_of_matching_expertise,
        $number_of_assignments
    ): float {

        $probability = 1 / (1 + exp(- ($number_of_matching_expertise - $number_of_assignments)));
        return $probability;
    }

    /**
     * Send notification to dietician
     * 
     * This method will send notification to dietician
     * 
     * @param User $user
     * @param Dietician $dietician
     * 
     * @return void
     * 
     */

    private function sendNotification(User $user, $dietician): void
    {


        if ($dietician->device_id == null) {
            Log::channel('notification')->error('=================== Unable to send notification ======================');
            Log::channel('notification')->error('No device id found for dietician: ' . $dietician->id . ' after assignment');
            Log::channel('notification')->error('====================================================================');
        } else {
            try {
                dispatch(
                    new NotificationJob(
                        title: 'New Assignment',
                        message: 'Hello ' . $dietician->name . ', you have been assigned a new assignment. Please check your app for more details.',
                        device_ids: [$dietician->device_id],
                    )
                );
            } catch (Exception $e) {
                Log::channel('notification')->error('=================== Unable to send notification ======================');
                Log::channel('notification')->error('Error sending notification to dietician: ' . $dietician->id . ' after assignment');
                Log::channel('notification')->error('Error: ' . $e->getMessage());
                Log::channel('notification')->error('From: ' . $e->getFile());
                Log::channel('notification')->error('Line: ' . $e->getLine());
                Log::channel('notification')->error('====================================================================');
            }
        }

        if ($user->device_id == null) {
            Log::channel('notification')->error('=================== Unable to send notification ======================');
            Log::channel('notification')->error('No device id found for user: ' . $user->id . ' after assignment');
            Log::channel('notification')->error('====================================================================');
        } else {

            try {

                dispatch(
                    new NotificationJob(
                        title: 'Congratulations, you have a new dietician',
                        message: 'Hello ' . $user->name . ', you have been assigned a new dietician. Please check your app for more details.',
                        device_ids: [$user->device_id],
                    )
                );
            } catch (Exception $e) {
                Log::channel('notification')->error('=================== Unable to send notification ======================');
                Log::channel('notification')->error('Error sending notification to user: ' . $user->id . ' after assignment');
                Log::channel('notification')->error('Error: ' . $e->getMessage());
                Log::channel('notification')->error('From: ' . $e->getFile());
                Log::channel('notification')->error('Line: ' . $e->getLine());
                Log::channel('notification')->error('====================================================================');
            }
        }
    }
}
