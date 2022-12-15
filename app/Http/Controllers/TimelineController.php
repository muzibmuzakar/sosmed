<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $notifs = auth()->user()->unreadNotifications;
        return view('dashboard', [
            'posts' => Post::with('user')->withCount('comments')->latest('id')->get(),
            'notifs' => $notifs
        ]);
    }
}
