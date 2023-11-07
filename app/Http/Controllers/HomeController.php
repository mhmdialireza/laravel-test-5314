<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Request;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $requests = Request::with('user')
            ->when($user->role == 0, function ($requests) use ($user) {
                $requests->where('user_id', $user->id);
            })
            ->orderBy('importance', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('home', compact('requests'));
    }
}
