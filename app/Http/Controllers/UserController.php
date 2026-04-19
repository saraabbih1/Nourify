<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function myNotifications()
    {
        return Auth::user()->notifications;
    }

    public function notificationsIndex()
    {
        $notifications = Notification::where('user_id', auth()->id())->latest()->get();
        return view('notifications.index', compact('notifications'));
    }
}
