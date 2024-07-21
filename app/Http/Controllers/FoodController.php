<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::orderBy("name", "asc")->get();
        return response()->json($foods);
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
                'cuisine' => "required",
                'category' => "required",
                "desc" => "required|string",
                'price' => "required|numeric",
                "filePath" => "required|image|mimes:jpeg,png,jpg",
            ]);

            $user = Auth::user();
            $restaurant_id = Restaurant::where("user_id", $user->id)->first();
            $validatedData['restaurant_id'] = $restaurant_id;
            $path = Storage::putFile('public/food', $request->file('img'));
            $path = asset("storage/" . substr($path, 7));
            $validatedData['img'] = $path;

            $food = Food::create($validatedData);

            return response()->json([
                "success" => "Added Successfully!",
                "cuisine" => $food,
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
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $food = Food::FindOrFail($id);
        $food->delete();
    }
}
