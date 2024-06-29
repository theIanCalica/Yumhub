<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Http\Requests\StoreManagerRequest;
use App\Http\Requests\UpdateManagerRequest;
use Illuminate\Validation\ValidationException;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $managers = Manager::orderBy("hired-date", "asc")->get();
        return response()->json($managers);
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
    public function store(StoreManagerRequest $request)
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
            ]);

            $manager = Manager::create([
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
            ]);

            return response()->json([
                "success" => "Added Successfully!",
                "manager" => $manager,
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
    public function show(Manager $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $manager = Manager::FindOrFail($id);
        return response()->json($manager);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateManagerRequest $request, Manager $manager)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $manager = Manager::FindOrFail($id);
        $manager->delete();
        $data = array('success' => 'deleted', 'code' => 200);
        return response()->json($data);
    }
}
