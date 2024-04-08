<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('read', false)->get();

        return view('admin.notifications', compact('notifications'));
    }

    public function markAsRead($id)
    {
        $notification = Notification::find($id);
        if ($notification) {
            $notification->read = true;
            $notification->save();
        }

        return response()->json(['success' => true]);
    }

    public function showDashboard()
    {
        $notifications = Notification::where('read', false)->get();

        return view('dashboard', compact('notifications'));
    }
}
