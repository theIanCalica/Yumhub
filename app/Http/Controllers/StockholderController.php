<?php

namespace App\Http\Controllers;

use App\Models\Stockholder;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class StockholderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stockholders = Stockholder::orderBy("investmentDate", "asc")->get();
        return response()->json($stockholders);
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
                "name" => "required|string|max:255",
                "sex" => "required|string|max:10",
                "dob" => "required|date",
                "email" => "required|email|unique:stockholders,email",
                "phoneNumber" => "required|digits:11|unique:stockholders,phoneNumber",
                "address" => "required|string|max:255",
                "sharesOwned" => "required|numeric",
                "investmentDate" => "required|date",
                "prefferedContact" => "required|string",
            ]);

            $stockholder = Stockholder::create([
                "name" => $validatedData["name"],
                "sex" => $validatedData["sex"],
                "dob" => $validatedData["dob"],
                "email" => $validatedData["email"],
                "phoneNumber" => $validatedData["phoneNumber"],
                "address" => $validatedData["address"],
                "sharesOwned" => $validatedData["sharesOwned"],
                "investmentDate" => $validatedData["investmentDate"],
                "prefferedContact" => $validatedData["prefferedContact"],
            ]);

            return response()->json([
                "success" => "Added Successfully1",
                "stockholder" => $stockholder,
                "status" => 202,
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
        $stockholder = Stockholder::FindOrFail($id);
        return response()->json($stockholder);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stockholder $stockholder)
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
                "name" => "required|string|max:255",
                "sex" => "required|string|max:10",
                "dob" => "required|date",
                "email" => "required|email|unique:stockholders,email",
                "phoneNumber" => "required|digits:11|unique:stockholders,phoneNumber",
                "address" => "required|string|max:255",
                "sharesOwned" => "required|numeric",
                "investmentDate" => "required|date",
                "prefferedContact" => "required|string",
            ]);

            $stockholder = Stockholder::FindOrFail($id);
            $stockholder->update($validatedData);
            return response()->json([
                "success" => "Added Successfully1",
                "stockholder" => $stockholder,
                "status" => 202,
            ]);
        } catch (ValidationException $e) {
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $stockholder = Stockholder::FindOrFail($id);
        $stockholder->delete();
        return response()->json([
            "success" => "Added Successfully1",
            "status" => 202,
        ]);
    }
}
