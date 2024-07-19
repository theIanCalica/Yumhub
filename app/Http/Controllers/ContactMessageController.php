<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contactMessages = ContactMessage::orderBy("subject", "asc")->get();
        return response()->json($contactMessages);
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
                "fname" => "required|string|max:255",
                "lname" => "required|string|max:255",
                "email" => "required|string|email|max:255",
                "subject" => "required|string",
                "message" => "required|string",

            ]);

            $validatedData = array_merge($validatedData, ['status' => 'Pending']);
            $contactMessage = ContactMessage::create($validatedData);

            return response()->json([
                "success" => "Added Successfully!",
                "contactMessage" => $contactMessage,
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
        $categoryMessage = ContactMessage::FindOrFail($id);
        return response()->json($categoryMessage);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactMessage $contactMessage)
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
                "fname" => "required|string|max:255",
                "lname" => "required|string|max:255",
                "email" => "required|string|email|max:255",
                "subject" => "required|string",
                "message" => "required|string",
            ]);

            $contactMessage = ContactMessage::FindOrFail($id);
            $contactMessage->update($validatedData);

            return response()->json([
                "success" => "Updated Successfully!",
                "contactMessage" => $contactMessage,
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
        $contactMessage = ContactMessage::FindOrFail($id);
        $contactMessage->delete();
        return response()->json([
            "success" => "Deleted Successfully!",
            "status" => 200,
        ]);
    }
}
