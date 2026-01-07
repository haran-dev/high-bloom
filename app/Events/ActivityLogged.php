<?php

namespace App\Events;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ActivityLogged implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    public array $notification;
    public int $userId;

    public function __construct(array $notification, int $userId)
    {
        $this->notification = $notification;
        $this->userId = $userId;
    }

    // 🔐 User-specific PRIVATE channel
    public function broadcastOn(): PrivateChannel
    {
        return new PrivateChannel('notifications.' . $this->userId);
    }

    // ✅ Clean event name for frontend
    public function broadcastAs(): string
    {
        return 'activity.logged';
    }
}
