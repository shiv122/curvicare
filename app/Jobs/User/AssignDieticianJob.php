<?php

namespace App\Jobs\User;

use Illuminate\Bus\Queueable;
use App\Models\DieticianAssignment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\DieticianAssignmentService;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class AssignDieticianJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $assignment;
    public function __construct(
        DieticianAssignment $assignment
    ) {
        $this->assignment = $assignment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $service = new DieticianAssignmentService();
        $service->assign($this->assignment);
    }
}
