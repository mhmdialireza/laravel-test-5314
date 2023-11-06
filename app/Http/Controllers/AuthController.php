<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $user = User::select('id', 'username', 'password')->where('username', $request->get('username'))->first();

        // dd($user->password, $request->password);..
        if (!Hash::check($request->password, $user->password)) {
            Redirect()->back()->with('message', 'چنین کاربری وجود ندارد.');
        } // TODO: set flush message in view
        //TODO: use attempt
        Auth::loginUsingId($user->id);

        return redirect()->to(route('dashboard'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->to(route('login'));
    }
}
