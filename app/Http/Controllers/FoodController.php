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

    public function get()
    {
        $user = Auth::user();
        return response()->json($user);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("seller.foods");
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
            $user = Auth::user();
            $restaurant = Restaurant::where("owner_id", $user->id)->first();

            $validatedData = $request->validate([
                "name" => "required|string|max:255",
                'cuisine_id' => "required",
                'category_id' => "required",
                'price' => "required|numeric",
                "filePath" => "required|image|mimes:jpeg,png,jpg",
            ]);

            $validatedData['restaurant_id'] = $restaurant->id;

            $path = Storage::putFile('public/food', $request->file('filePath'));
            $path = asset("storage/" . substr($path, 7));
            $validatedData['filePath'] = $path;

            $food = Food::create($validatedData);

            return redirect()->route("foods.index")->with(["icon" => "success", "title" => "Hooray!", "text" => "You added new food!"]);
        } catch (ValidationException $e) {
            return redirect()->route("foods.index")->with(["icon" => "error", "title" => "Warning!", "text" => $e->errors()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $food = Food::FindOrFail($id);
        return response()->json($food);
    }

    public function getSingleFood(string $id)
    {
        $food = Food::FindOrFail($id);
        return response()->json($food);
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
        dd($request);
        try {
            $validatedData = $request->validate([
                "name" => "required|string|max:255",
                'cuisine_id' => "required",
                'category_id' => "required",
                'user_id' => "required",
                "desc" => "required|string",
                'price' => "required|numeric",
                "filePath" => "required|image|mimes:jpeg,png,jpg",
            ]);

            $food = Food::FindOrFail($id);

            $restaurant = Restaurant::where("owner_id", $validatedData['user_id'])->first();
            $validatedData['restaurant_id'] = $restaurant->id;

            if ($request->hasFile("filePath")) {
                unlink(substr($food->filePath, 22));
                $path = Storage::putFile('public/food', $request->file('filePath'));
                $path = asset("storage/" . substr($path, 7));
                $validatedData['filePath'] = $path;
                $food->update($validatedData);
            } else {
                $food->update($validatedData);
            }

            return response()->json([
                "success" => "Updated Successfully!",
                "food" => $food,
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
        $food = Food::FindOrFail($id);
        unlink(substr($food->filePath, 22));
        $food->delete();
    }

    public function getFoods()
    {
        $foods = Food::with(['category', 'cuisine'])
            ->orderBy('name', 'asc')
            ->get();
        return response()->json($foods);
    }
}
