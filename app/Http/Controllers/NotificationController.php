<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function markAllAsRead()
    {
        foreach(auth()->user()->userable->unreadNotifications as $notification)
        {
            $notification->markAsRead();
        }

        return redirect()->back();
    }
}
