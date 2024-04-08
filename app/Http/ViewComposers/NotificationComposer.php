<?php

namespace App\Http\ViewComposers;

use App\Models\Notification;
use Illuminate\View\View;

class NotificationComposer
{
    public function compose(View $view)
    {
        $unreadNotificationsCount = Notification::where('read', false)->count();
        $view->with('unreadNotificationsCount', $unreadNotificationsCount);
    }
}
