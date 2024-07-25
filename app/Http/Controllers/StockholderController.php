<?php

namespace App\Http\Controllers;

use App\Imports\StockholderImport;
use App\Models\Stockholder;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                "name" => "required|string|max:255",
                "sex" => "required|string|max:10",
                "dob" => "required|date",
                "email" => "required|email|unique:stockholders,email," . $id,
                "phoneNumber" => "required|digits:11|unique:stockholders,phoneNumber," . $id,
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
        $stockholder = Stockholder::FindOrFail($id);
        $stockholder->delete();
        return response()->json([
            "success" => "Added Successfully1",
            "status" => 202,
        ]);
    }

    public function import(Request $request)
    {
        if ($request->hasFile("fileInput")) {
            $file = $request->file('fileInput');
            Excel::import(new StockholderImport, $file);
            return redirect()->route('stockholders')
                ->with('success', 'File imported successfully.');
        }
    }
}
