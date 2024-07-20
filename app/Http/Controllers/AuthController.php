<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {

            if (Auth::user()->email_verified_at === null && Auth::user()->role != "Admin") {
                return response()->json(["status" => 300, "icon" => "info", "title" => "Attention!", "message" => "We sent you an email confirmation, please verify your email first! "]);
            }

            $user = Auth::user();
            Auth::login(Auth::user());
            if ($user->role === "Admin") {

                return response()->json([
                    "status" => 200,
                    "icon" => "success",
                    "title" => "Hooray!",
                    "message" => "You have successfully logged in!",
                    'role' => "Admin",
                    'user' => $user,
                ]);
            } else if ($user->role === "Seller") {
                return response()->json([
                    "status" => 200,
                    "icon" => "success",
                    "title" => "Hooray!",
                    "message" => "You have successfully logged in!",
                    'role' => "Seller",
                    'user' => Auth::user(),
                ]);
            } else if ($user->role === "Customer") {
                return response()->json([
                    "status" => 200,
                    "icon" => "success",
                    "title" => "Hooray!",
                    "message" => "You have successfully logged in!",
                    'role' => "Customer",
                ]);
            }
        } else {
            return response()->json(["status" => 500, "icon" => "warning", "title" => "Warning!", "message" => "Incorrect email or password!"]);
        }
    }

    public function logout(Request $request)
    {
        Auth::Logout();
        return redirect()->route('sign-in')->with([
            'message' => 'Logout Successful',
            'icon' => 'success'
        ]);
    }
}
