<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProcessFileEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Status message.
     *
     * @var string
     */
    public $status;

    /**
     * Message.
     *
     * @var string
     */
    public $message;

    public $broadcastQueue = 'notifications';

    /**
     * Create a new event instance.
     *
     * @param  string $message
     * @return void
     */
    public function __construct($message, $status)
    {
        $this->message = $message;
        $this->status = $status;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('filesChannel');
    }
}
