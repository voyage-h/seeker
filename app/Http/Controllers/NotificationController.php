<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $notifications = Auth::user()->notifications()->simplePaginate(20);
        return view('notification.show',compact('notifications'));
    }

    //标记全部消息为已读
    public function read()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return back();
    }
}
