<?php

namespace App\Listeners;

use App\Events\NewOrderEvent;
use App\Models\Notification;

class SendAdminNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewOrderEvent $event): void
    {
        Notification::create([
            'type' => 'new_order',
            'message' => 'New order received: Order ID '.$event->order->id,
            'read' => false,
        ]);
    }
}
