<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy("name", "asc")->get();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "name" => "required|string|max:255",
            ]);

            $category = Category::create($validatedData);

            return response()->json([
                "success" => "Added Successfully!",
                "category" => $category,
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
        $category = Category::FindOrFail($id);
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                "id" => "required|string",
                "name" => "required|string|max:255",
            ]);
            $category = Category::FindOrFail($id);
            $category->update($validatedData);

            return response()->json([
                "success" => "Updated Successfully!",
                "category" => $category,
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
        $category = Category::FindOrFail($id);
        $category->delete();
        return response()->json([
            "success" => "Deleted Successfully!",
            "status" => 200,
        ]);
    }
}
