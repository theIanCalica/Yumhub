<?php

namespace App\Http\Controllers;

use App\Models\Rider;
use App\Http\Requests\StoreRiderRequest;
use App\Http\Requests\UpdateRiderRequest;
use Illuminate\Validation\ValidationException;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $riders = Rider::orderBy("hired-date", "asc")->get();
        return response()->json($riders);
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
    public function store(StoreRiderRequest $request)
    {
        try {
            $validatedData = $request->validate([
                "fname" => "required|string|max:255",
                "lname" => "required|string|max:255",
                "sex" => "required|string|max:10",
                "DOB" => "required|date",
                "phoneNumber" => "required|digits:11|unique:managers,phoneNumber",
                "email" => "required|email|unique:managers,email",
                "hired-date" => "required|date",
                "employmentstatus" => "required|string|max:50",
                "salary" => "required|numeric|min:0",
                "address" => "required|string|max:255",
                'motor-model' => "required|string|max:255",
            ]);

            $rider = Rider::create([
                "fname" => $validatedData["fname"],
                "lname" => $validatedData["lname"],
                "sex" => $validatedData["sex"],
                "DOB" => $validatedData["DOB"],
                "phoneNumber" => $validatedData["phoneNumber"],
                "email" => $validatedData["email"],
                "hired-date" => $validatedData["hired-date"],
                "employmentstatus" => $validatedData["employmentstatus"],
                "salary" => $validatedData["salary"],
                "address" => $validatedData["address"],
                'motor-model' => $validatedData["motor-model"],
            ]);

            return response()->json([
                "success" => "Added Successfully1",
                "rider" => $rider,
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
    public function show(Rider $rider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rider $rider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRiderRequest $request, Rider $rider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rider = Rider::FindOrFail($id);
        $rider->delete();
        $data = array('success' => 'deleted', 'code' => 200);
        return response()->json($data);
    }
}
