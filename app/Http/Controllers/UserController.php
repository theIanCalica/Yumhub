<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmMail;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy("role", "asc")->get();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => "required|unique:users",
                'password' => "required|min:6",
                'fname' => "required",
                'lname' => "required",
                'gender' => "required|max:5",
                'dob' => "required",
                'phoneNumber' => "required|max:11",
                'address' => "required",
                'role' => "required",
                'is_Disabled' => "required",
            ]);

            $user = User::create($validatedData);

            $verifyUser = VerifyUser::create([
                'token' => Str::random(60),
                'user_id' => $user->id,
            ]);

            Mail::to($user->email)->send(new ConfirmMail($user));
            return response()->json([
                "success" => "Registered successfully.",
                "region" => $user,
                "status" => 200
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed.',
                'errors' => $e->errors(),
                'status' => 422
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::FindOrFail($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::FindOrFail($id);
        return view("admin.profile");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'fname' => "required|max:255",
                'lname' => "required|max:255",
                'gender' => "required|max:5",
                'dob' => "required|date",
                'phoneNumber' => 'required|max:11|min:11|unique:users,phoneNumber,' . $id,
                'email' => 'required|email|unique:users,email,' . $id,
                'address' => "required",
                'role' => "required",
                'is_Disabled' => "required",
            ]);

            $user = User::FindOrFail($id);
            $user->update($validatedData);

            return response()->json([
                "title" => "Success!",
                "message" => "You updated the users details!",
                "icon" => "success",
                "user" => $user,
                "status" => 200
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed.',
                'errors' => $e->errors(),
                'status' => 422,
                'id' => $id
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::FindOrFail($id);
        $user->delete();
        return response()->json([
            "success" => "Deleted Successfully!",
            "status" => 202,
        ]);
    }

    public function verifyEmail($token)
    {
        $verifiedUser = VerifyUser::where('token', $token)->first();
        if (isset($verifiedUser)) {
            $user = $verifiedUser->user;
            if (!$user->email_verified_at) {
                $user->email_verified_at = Carbon::now();
                $user->save();
                return redirect()->route('sign-in')->with([
                    'icon' => 'success',
                    'message' => 'Email Verified!'
                ]);
            } else {
                return redirect()->route('sign-in')->with(["icon" => "info", "message" =>  "Email already verified!"]);
            }
        } else {
            return redirect()->route('sign-in')->with(["icon" => "danger", "message" =>  "Something went wrong!"]);
        }
    }

    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'fname' => "required|string|max:255",
                'lname' => "required|string|max:255",
                'gender' => "required|string",
                'dob' => "required|date",
                'address' => "required",
                'phoneNumber' => "required|min:11|max:11|unique:users",
                'email' => "required|email|unique:users",
                'password' => "required|min:6",
                'role' => "required|string",
            ]);

            $user = User::create($validatedData);

            $verifyUser = VerifyUser::create([
                'token' => Str::random(60),
                'user_id' => $user->id,
            ]);

            Mail::to($user->email)->send(new ConfirmMail($user));
            return response()->json([
                'title' => "Successfully Registered!",
                'icon' => "success",
                "user" => $user,
                "status" => 200
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed.',
                'errors' => $e->errors(),
                'status' => 422,
                'title' => "Error Occured!",
                'icon' => "error",
            ]);
        }
    }

    public function registerSeller(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'fname' => "required|string|max:255",
                'lname' => "required|string|max:255",
                'gender' => "required|string",
                'dob' => "required|date",
                'phoneNumber' => "required|min:11|max:11|unique:users",
                'email' => "required|email|unique:users",
                'password' => "required|min:6",
                'role' => "required|string",
            ]);

            $user = User::create($validatedData);

            $verifyUser = VerifyUser::create([
                'token' => Str::random(60),
                'user_id' => $user->id,
            ]);

            Mail::to($user->email)->send(new ConfirmMail($user));
            return response()->json([
                'title' => "Successfully Registered!",
                'icon' => "success",
                "user" => $user,
                "status" => 200
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed.',
                'errors' => $e->errors(),
                'status' => 422,
                'title' => "Error Occured!",
                'icon' => "error",
            ]);
        }
    }

    public function checkEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            echo "false";
        } else {
            echo "true";
        }
    }

    public function checkPhoneNumber(Request $request)
    {
        $user = User::where("phoneNumber", $request->phoneNumber)->first();
        if ($user) {
            echo "false";
        } else {
            echo "true";
        }
    }
}
