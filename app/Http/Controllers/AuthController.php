<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->email_verified_at === null && Auth::user()->role != "Admin") {
                return response()->json(["status" => 300, "icon" => "info", "title" => "Attention!", "message" => "We sent you an email confirmation, please verify your email first! "]);
            }

            $user = Auth::user();
            Session::put('user', $user);
            if ($user->role === "Admin") {
                return response()->json([
                    "status" => 200,
                    "icon" => "success",
                    "title" => "Hooray!",
                    "message" => "You have successfully logged in!",
                    'role' => "Admin",

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

    public function logout()
    {
        Auth::Logout();
        return response()->json(["status" => 202, "icon" => "success", "title" => "Goodbye!", "message" => "You successfully logout!"]);
    }
}
