<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
         $users = User::all();
        return view('dashboard.users.index',compact('users'));
    }


 public function notifications()
{
    $user = auth()->user();

    return view('layouts.dashboard._header', [
        'notifications' => $user->notifications,
        'unread' => $user->unreadNotifications,
    ]);
}

}

