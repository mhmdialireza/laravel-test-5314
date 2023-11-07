<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        if (!Hash::check($request->password, $user->password)) {
           return redirect()->back()->with('message', 'چنین کاربری وجود ندارد.');
        }

        Auth::loginUsingId($user->id);

        return redirect()->to(route('home'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->to(route('login'));
    }
}
