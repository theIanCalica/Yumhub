<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Http\Requests\StoreProvinceRequest;
use App\Http\Requests\UpdateProvinceRequest;
use Illuminate\Validation\ValidationException;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $provinces = Province::orderBy("provinceName", 'asc')->get();
        return response()->json($provinces);
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
    public function store(StoreProvinceRequest $request)
    {
        try {
            $validatedData = $request->validate([
                'region_id' => 'required',
                'provinceName' => 'required|min:3|unique:provinces'
            ]);

            $province = Province::create([
                'provinceName' => $validatedData["provinceName"],
                'region_id' => $validatedData["region_id"],
            ]);

            return response()->json([
                "success" => "Province created successfully",
                "status" => 200,
                "province" => $province
            ]);
        } catch (ValidationException $e) {
            return response()->json([]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Province $province)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Province $province)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProvinceRequest $request, Province $province)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $province = Province::FindOrFail($id);
            $province->delete();
            return response()->json([
                "message" => "Province successfully deleted!",
                "status" => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete region.',
                'message' => $e->getMessage(),
                'status' => 500
            ]);
        }
    }
}
