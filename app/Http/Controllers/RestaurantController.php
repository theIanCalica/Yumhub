<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'owner_id' => "required",
                "name" => "required|string|max:255",
                'address' => "required|string",
                "phoneNumber" => "required|string|min:11|max:11|unique:restaurants",
                'email' => "required|email|unique:restaurants",
                "logo_filePath" => "required|image|mimes:jpeg,png,jpg",
                'desc' => "required|string",
                "banner" => "required|image|mimes:jpeg,png,jpg",
                'operatingHours' => "required|string",
            ]);
            $path = Storage::putFile('public/restaurant/logo', $request->file('logo_filePath'));
            $path = asset("storage/" . substr($path, 7));
            $validatedData['logo_filePath'] = $path;

            $bannerPath = Storage::putFile('public/restaurant/banner', $request->file('banner'));
            $bannerPath = asset("storage/" . substr($bannerPath, 7));
            $validatedData['banner'] = $bannerPath;

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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                "name" => "required|string|max:255",
                'address' => "required|string",
                "phoneNumber" => [
                    "required",
                    "string",
                    "min:11",
                    "max:11",
                    Rule::unique('restaurants', 'phoneNumber')->ignore($id),
                ],
                'email' => [
                    "required",
                    "email",
                    Rule::unique('restaurants', 'email')->ignore($id),
                ],
                'operatingHours' => "required|string",
            ]);

            $restaurant = Restaurant::FindOrFail($id);

            if ($request->hasFile("banner_file")) {
                unlink(substr($restaurant->banner, 22));
                $path = Storage::putFile('public/restaurant/banner', $request->file('banner_file'));
                $path = asset("storage/" . substr($path, 7));
                $validatedData['banner'] = $path;
            }

            if ($request->hasFile("logo_file")) {
                unlink(substr($restaurant->logo_filePath, 22));
                $profilePath = Storage::putFile('public/restaurant/logo', $request->file('logo_file'));
                $profilePath = asset("storage/" . substr($profilePath, 7));
                $validatedData['logo_filePath'] = $profilePath;
            }

            $restaurant->update($validatedData);
            return response()->json([
                "success" => "Updated successfully.",
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

    public function checkPhoneNum(Request $request)
    {
        $restaurant = Restaurant::where("phoneNumber", $request->phoneNumber)->first();
        if ($restaurant) {
            echo "false";
        } else {
            echo "true";
        }
    }

    public function checkEmail(Request $request)
    {
        $restaurant = Restaurant::where("email", $request->email)->first();
        if ($restaurant) {
            echo "false";
        } else {
            echo "true";
        }
    }

    public function showProfile(string $id)
    {
        $restaurant = Restaurant::where("owner_id", $id)->first();
        return view("seller.restaurant", compact("restaurant"));
    }
}
