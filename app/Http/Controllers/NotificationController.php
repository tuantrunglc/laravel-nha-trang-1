<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;


class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('read', false)->get();
        return view('admin.dashboard', compact('notifications'));
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
}
