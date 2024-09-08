<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class notificationController extends Controller
{
    public function notification_read($id)
    {
        $notification = Auth::user()->notifications->find($id);
        $notification->markAsRead();
        return redirect()->back();
    }
}
