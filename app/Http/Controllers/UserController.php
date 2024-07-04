<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
                'phoneNumber' => "required|max:11",
                'role' => "required",
            ]);

            $user = User::create([
                'email' => $validatedData["email"],
                'password' => $validatedData["password"],
                'fname' => $validatedData["fname"],
                'lname' => $validatedData['lname'],
                'phoneNumber' => $validatedData["phoneNumber"],
                'role' => $validatedData["role"]
            ]);

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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
