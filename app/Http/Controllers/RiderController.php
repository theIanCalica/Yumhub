<?php

namespace App\Http\Controllers;

use App\Imports\RiderImport;
use App\Models\Rider;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $riders = Rider::orderBy("hiredDate", "asc")->get();
        return response()->json($riders);
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
                'motorModel' => "required|string|max:255",
            ]);

            $rider = Rider::create([
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
                'motorModel' => $validatedData["motorModel"],
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
    public function show(string $id)
    {
        $rider = Rider::FindOrFail($id);
        return response()->json($rider);
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
                "phoneNumber" => "required|digits:11|unique:managers,phoneNumber",
                "email" => "required|email|unique:managers,email",
                "hired-date" => "required|date",
                "employmentstatus" => "required|string|max:50",
                "salary" => "required|numeric|min:0",
                "address" => "required|string|max:255",
                'motor-model' => "required|string|max:255",
            ]);

            $rider = Rider::FindOrFail($id);
            $rider->update($validatedData);
            return response()->json([
                "success" => "Added Successfully",
                "rider" => $rider,
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
        $rider = Rider::FindOrFail($id);
        $rider->delete();
        $data = array('success' => 'deleted', 'code' => 200);
        return response()->json($data);
    }

    public function import(Request $request)
    {
        // Validate the file input
        $validator = Validator::make($request->all(), [
            'fileInput' => 'required|file|mimes:xlsx,xls',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            if ($request->hasFile('fileInput')) {
                $file = $request->file('fileInput');
                Excel::import(new RiderImport, $file);
                return redirect()->route('riders')
                    ->with('success', 'File imported successfully.');
            } else {
                return response()->json(['error' => 'No file uploaded.'], 400);
            }
        } catch (\Exception $e) {

            return response()->json(['error' => 'An error occurred during file import.', "Here are the errors" => $e->getMessage()], 500);
        }
    }
}
