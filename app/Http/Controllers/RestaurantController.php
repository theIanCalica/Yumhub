<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::orderBy("name", "asc")->get();
        return response()->json($restaurants);
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
                'address' => "required|string",
                "phoneNumber" => "required|string|min:11|max:11|unique:restaurants",
                'email' => "required|email|unique:restaurants",
                'logo_filePath' => "required|string",
                'desc' => "required|string",
                'operatingHours' => "required|string",
            ]);

            $restaurant = Restaurant::create($validatedData);
            return response()->json([
                "success" => "Registered Restaurant successfully.",
                "restaurant" => $restaurant,
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
        $restaurant = Restaurant::FindOrFail($id);
        return response()->json($restaurant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
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
                'address' => "required|string",
                "phoneNumber" => "required|string|min:11|max:11|unique:restaurants",
                'email' => "required|email|unique:restaurants",
                'logo_filePath' => "required|string",
                'desc' => "required|string",
                'operatingHours' => "required|string",
            ]);

            $restaurant = Restaurant::FindOrFail($id);
            $restaurant->update($validatedData);
            return response()->json([
                "success" => "Registered Restaurant successfully.",
                "restaurant" => $restaurant,
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
        $restaurant = Restaurant::FindOrFail($id);
        $restaurant->delete();
        return response()->json([
            "success" => "Deleted Successfully1",
            "status" => 202,
        ]);
    }
}
