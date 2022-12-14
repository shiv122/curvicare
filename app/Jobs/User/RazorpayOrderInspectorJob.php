<?php

namespace App\Jobs\User;

use App\Models\RazorpayOrder;
use App\Services\User\UserPaymentFetchService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RazorpayOrderInspectorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $order;
    public $tries = 3;
    public $timeout = 60;


    public function __construct(
        RazorpayOrder $order
    ) {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $paymentFetchService = new UserPaymentFetchService();
        $paymentFetchService->fetch($this->order);
    }
}
