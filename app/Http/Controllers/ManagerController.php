<?php

namespace App\Http\Controllers;

use App\Imports\ManagerImport;
use App\Models\Manager;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $managers = Manager::orderBy("created_at", "asc")->get();
        return response()->json($managers);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "fname" => "required|string|max:255",
                "lname" => "required|string|max:255",
                "sex" => "required|string|max:10",
                "DOB" => "required|date",
                "phoneNumber" => "required|digits:11|unique:managers,phoneNumber",
                "email" => "required|email|unique:managers,email",
                "hiredDate" => "required|date",
                "employmentStatus" => "required|string|max:50",
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
                "hiredDate" => $validatedData["hiredDate"],
                "employmentStatus" => $validatedData["employmentStatus"],
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
    public function show(string $id)
    {
        $manager = Manager::FindOrFail($id);
        return response()->json($manager);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                "fname" => "required|string|max:255",
                "lname" => "required|string|max:255",
                "sex" => "required|string|max:10",
                "DOB" => "required|date",
                "phoneNumber" => [
                    "required",
                    "digits:11",
                    Rule::unique('managers')->ignore($id),
                ],
                "email" => [
                    "required",
                    "email",
                    Rule::unique('managers')->ignore($id),
                ],
                "hiredDate" => "required|date",
                "employmentStatus" => "required|string|max:50",
                "salary" => "required|numeric|min:0",
                "address" => "required|string|max:255",
            ]);

            $manager = Manager::FindOrFail($id);
            $manager->update($validatedData);
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $manager = Manager::FindOrFail($id);
        $manager->delete();
        $data = array('success' => 'deleted', 'code' => 200);
        return response()->json($data);
    }

    public function checkEmail(Request $request)
    {
        $manager = Manager::where("email", $request->email)->first();
        if ($manager) {
            echo "false";
        } else {
            echo "true";
        }
    }

    public function checkPhoneNum(Request $request)
    {
        $manager = Manager::where("phoneNumber", $request->phoneNumber)->first();
        if ($manager) {
            echo "false";
        } else {
            echo "true";
        }
    }

    public function import(Request $request)
    {

        if ($request->hasFile('fileInput')) {
            $file = $request->file('fileInput');


            Excel::import(new ManagerImport, $file);
            return redirect()->route("managers");
        }
    }
}
