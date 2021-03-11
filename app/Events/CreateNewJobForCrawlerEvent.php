<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateNewJobForCrawlerEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $job;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($job)
    {
        $this->job= $job;
    }
}
