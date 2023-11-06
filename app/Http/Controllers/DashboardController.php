<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $roles = auth()->user()->roles;

        $requests = Request::with('user')->when(!Role::managerOrSupervisor($roles), function ($requests) {
            $requests->where('user_id', auth()->id());
        })->get();
        // ->paginate(10);

        return view('dashboard', compact('requests'));
    }
}
