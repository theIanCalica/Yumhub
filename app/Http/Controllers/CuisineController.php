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

            $path = Storage::putFile('public/cuisines', $request->file('img_url'));
            $path = asset("storage/" . substr($path, 7));
            $validatedData['img_url'] = $path;

            $cuisine = Cuisine::create($validatedData);

            return response()->json([
                "success" => "Added Successfully!",
                "cuisine" => $cuisine,
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                "id" => "required",
                "name" => "required|string|max:255",
                "desc" => "required|string",
                "img_url" => "image|mimes:jpeg,png,jpg",
            ]);

            $cuisine = Cuisine::FindOrFail($id);
            if ($request->hasFile("img_url")) {
                $path = Storage::putFile('public/cuisines/', $request->file('img_url'));
                unlink("storage/" . substr($cuisine->img_url, 7));
                $validatedData['img_url'] = $path;
                $cuisine->update($validatedData);
            } else {
                $cuisine->update($validatedData);
            }


            return response()->json([
                "success" => "Added Successfully!",
                "cuisine" => $cuisine,
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
        unlink("storage/" . substr($cuisine->img_url, 7));
        $cuisine->delete();
        return response()->json([
            "success" => "Deleted Successfully!",
            "status" => 200,
        ]);
    }
}
