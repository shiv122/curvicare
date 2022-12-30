<?php

namespace App\Jobs\Notification;

use Exception;
use Illuminate\Bus\Queueable;
use Berkayk\OneSignal\OneSignalFacade;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $title = null;
    public $message = null;
    public $device_ids = [];
    public $small_picture = null;
    public $big_picture = null;
    public $channel = null;

    public function __construct(string $title, string $message, array|null $device_ids = null, string $small_picture = null, string $big_picture = null, string $channel = null)
    {
        $this->title = $title;
        $this->message = $message;
        $this->device_ids = $device_ids;
        $this->small_picture = $small_picture;
        $this->big_picture = $big_picture;
        $this->channel = $channel;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $params = [];
        $contents = ["en" => $this->message,];

        if (!empty($this->device_ids)) {
            $params['include_player_ids'] = $this->device_ids;
        } else {
            $params['included_segments'] = ['All'];
        }
        $params['contents'] = $contents;
        $params['headings'] = ["en" => $this->title,];
        $params['data'] =  ['msg' => 'hello there'];
        $params['large_icon'] = $this->small_picture ?? asset('images/logo/logo.png');
        if ($this->channel) {
            $params['android_channel_id'] = $this->channel;
        }
        if ($this->big_picture != null) {
            $params['big_picture'] = $this->big_picture;
            // $params['ios_attachments'] = ['id' => asset($img)];
        }
        try {
            $signal =   OneSignalFacade::sendNotificationCustom($params);
            return $signal;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
