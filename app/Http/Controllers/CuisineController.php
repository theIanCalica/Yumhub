<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;

class CuisineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cuisines = Cuisine::orderBy("name", "asc")->get();
        return response()->json($cuisines);
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
                "desc" => "required|string",
                "img_url" => "required|image|mimes:jpeg,png,jpg",
            ]);

            $path = Storage::putFile('public/cuisines/', $request->file('img_url'));
            $validatedData['img_url'] = $path;

            $cuisine = Cuisine::create($validatedData);

            return response()->json([
                "success" => "Added Successfully!",
                "manager" => $cuisine,
                "status" => 200,
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
        $cuisine = Cuisine::FindOrFail($id);
        return response()->json($cuisine);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cuisine $cuisine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cuisine $cuisine)
    {
        try {
            $validatedData = $request->validate([
                "id" => "required",
                "name" => "required|string|max:255",
                "desc" => "required|string",
                "img_url" => "required|image|mimes:jpeg,png,jpg",
            ]);

            $path = Storage::putFile('public/cuisines/', $request->file('img_url'));
            $validatedData['img_url'] = $path;

            $cuisine = Cuisine::create($validatedData);

            return response()->json([
                "success" => "Added Successfully!",
                "manager" => $cuisine,
                "status" => 200,
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
        $cuisine = Cuisine::FindOrFail($id);
        $cuisine->delete();
        return response()->json([
            "success" => "Deleted Successfully!",
            "status" => 200,
        ]);
    }
}
