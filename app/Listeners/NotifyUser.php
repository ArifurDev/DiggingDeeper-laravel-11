<?php

namespace App\Listeners;

use App\Events\UserNotice;
use App\Mail\UserMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyUser
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
    public function handle(UserNotice $event): void
    {
        // Send a mail to the user
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new UserMail($event->data));
        }
    }
}
