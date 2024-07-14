<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->email_verified_at === null) {
                return response()->json(["status" => 500, "icon" => "info", "title" => "Attention!", "message" => "We sent you an email confirmation, please verify your email first! "]);
            }
        }
    }

    public function logout()
    {
        Auth::Logout();
        return response()->json(["status" => 202, "icon" => "success", "title" => "Goodbye!", "message" => "You successfully logout!"]);
    }
}
