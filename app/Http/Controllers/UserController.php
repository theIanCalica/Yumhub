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
                'role' => "required",
            ]);

            $user = User::create([
                'email' => $validatedData["email"],
                'password' => $validatedData["password"],
                'fname' => $validatedData["fname"],
                'lname' => $validatedData['lname'],
                'gender' => $validatedData['gender'],
                'dob' => $validatedData['dob'],
                'phoneNumber' => $validatedData["phoneNumber"],
                'role' => $validatedData["role"],
            ]);

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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'email' => "required|unique:users",
                'password' => "required|min:6",
                'fname' => "required",
                'lname' => "required",
                'phoneNumber' => "required|max:11",
                'role' => "required",
            ]);

            $user = User::FindOrFail($id);
            $user->update($validatedData);

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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::FindOrFail($id);
        $user->delete();
        return response()->json([
            "success" => "Added Successfully1",
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
                session()->flash('status_code', 'success');
                session()->flash('status', 'Successfully Verified!');
                return redirect()->route('login-patient');
            } else {
                session()->flash('status_code', 'info');
                session()->flash('status', 'Email already verified');
                return redirect()->route('login-patient');
            }
        } else {
            session()->flash('status_code', 'error');
            session()->flash('status', 'Something went wrong!');
            return redirect()->route('login-patient');
        }
    }
}
