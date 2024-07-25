<?php

namespace App\Http\Controllers;

use App\Models\Cuisine;
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
        $user = Auth::user();
        $resto = Restaurant::where("owner_id", $user->id)->first();
        $foods = Food::with(['category', 'cuisine'])
            ->where('restaurant_id', $resto->id)
            ->orderBy('name', 'asc')
            ->get();
        return view("seller.foods", compact("foods"));
    }

    public function search($query)
    {
        $foods = Food::search($query)->get();
        return $foods;
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $restaurant = Restaurant::where("owner_id", $user->id)->first();

        try {
            $validatedData = $request->validate([
                "name" => "required|string|max:255",
                'cuisine_id' => "required",
                'category_id' => "required",
                'price' => "required|numeric",
                "filePath" => "required|image|mimes:jpeg,png,jpg",
            ]);
            $food = Food::FindOrFail($id);
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
            return redirect()->route("foods.index")->with(["icon" => "success", "title" => "Hooray!", "text" => "You updated food!"]);
        } catch (ValidationException $e) {
            return redirect()->route("foods.index")->with(["icon" => "error", "title" => "Warning!", "text" => $e->errors()]);
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
        return redirect()->route("foods.index")->with(["icon" => "success", "title" => "Hooray!", "text" => "Successfully Deleted!"]);
    }

    public function getFoods()
    {
        $foods = Food::with(['category', 'cuisine'])
            ->orderBy('name', 'asc')
            ->get();
        return response()->json($foods);
    }

    public function getFoodBasedOnCuisine(string $name)
    {

        $cuisine = Cuisine::where("name", $name)->first();
        $foods = Food::where("cuisine_id", $cuisine->id)->get();
        return view("customer.cuisineBased", compact("foods"));
    }

    public function filters(Request $request)
    {
        $category = $request->input('category');
        $cuisine = $request->input('cuisine');

        // Start with a query to get all foods with related category and cuisine
        $query = Food::with(['category', 'cuisine'])
            ->orderBy('name', 'asc');

        // Apply filters if they are provided
        if ($category) {
            $query->where('category_id', $category);
        }

        if ($cuisine) {
            $query->where('cuisine_id', $cuisine);
        }

        // Execute the query and get the results
        $foods = $query->get();

        // Return the filtered foods as JSON response
        return response()->json($foods);
    }
}
