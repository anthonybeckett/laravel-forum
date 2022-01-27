<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function notifications(){
        //Mark all as read
        auth()->user()->unreadNotifications->markAsRead();

        return view('users.notifications', [
            'notifications' => auth()->user()->notifications()->paginate(10)
        ]);
    }
}
