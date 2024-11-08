<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmMail;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::orderBy("role", "asc")->get();
        return response()->json($users);
    }

    public function getRecentUsers()
    {
        $recentUsers = User::orderBy('created_at', 'desc')->take(6)->get();
        return response()->json(["data" => $recentUsers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'email' => "required|unique:users",
                'password' => "required|min:6",
                'fname' => "required",
                'lname' => "required",
                'gender' => "required|max:5",
                'dob' => "required",
                'phoneNumber' => "required|max:11",
                'address' => "required",
                'role' => "required",
                'is_Disabled' => "required",
            ]);

            $user = User::create($validatedData);

            $verifyUser = VerifyUser::create([
                'token' => Str::random(60),
                'user_id' => $user->id,
            ]);

            Mail::to($user->email)->send(new ConfirmMail($user));
            return response()->json([
                "success" => "Registered successfully.",
                "region" => $user,
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
        $user = User::FindOrFail($id);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::FindOrFail($id);
        return view("admin.profile");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedData = $request->validate([
                'fname' => 'required|max:255',
                'lname' => 'required|max:255',
                'gender' => 'required|max:5',
                'dob' => 'required|date',
                'phoneNumber' => 'required|max:11|min:11|unique:users,phoneNumber,' . $id,
                'email' => 'required|email|unique:users,email,' . $id,
                'address' => 'required',
                'role' => 'required',
                'status' => 'required|boolean',
            ]);

            $user = User::findOrFail($id);
            $user->update($validatedData);

            return response()->json([
                "title" => "Success!",
                "message" => "You updated the user's details!",
                "icon" => "success",
                "user" => $user,
                "status" => 200
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed.',
                'errors' => $e->errors(),
                'status' => 422,
                'id' => $id
            ]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::FindOrFail($id);
        $user->delete();
        return response()->json([
            "success" => "Deleted Successfully!",
            "status" => 202,
        ]);
    }

    public function verifyEmail($token)
    {
        $verifiedUser = VerifyUser::where('token', $token)->first();
        if (isset($verifiedUser)) {
            $user = $verifiedUser->user;
            if (!$user->email_verified_at) {
                $user->email_verified_at = Carbon::now();
                $user->save();
                return redirect()->route('sign-in')->with([
                    'icon' => 'success',
                    'message' => 'Email Verified!'
                ]);
            } else {
                return redirect()->route('sign-in')->with(["icon" => "info", "message" =>  "Email already verified!"]);
            }
        } else {
            return redirect()->route('sign-in')->with(["icon" => "danger", "message" =>  "Something went wrong!"]);
        }
    }

    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'fname' => "required|string|max:255",
                'lname' => "required|string|max:255",
                'gender' => "required|string",
                'dob' => "required|date",
                'address' => "required",
                'phoneNumber' => "required|min:11|max:11|unique:users",
                'email' => "required|email|unique:users",
                "filePath" => "required|image|mimes:jpeg,png,jpg",
                'password' => "required|min:6",
                'role' => "required|string",
            ]);

            $path = Storage::putFile('public/users/customer', $request->file('filePath'));
            $path = asset("storage/" . substr($path, 7));
            $validatedData['filePath'] = $path;


            $user = User::create($validatedData);

            $verifyUser = VerifyUser::create([
                'token' => Str::random(60),
                'user_id' => $user->id,
            ]);

            Mail::to($user->email)->send(new ConfirmMail($user));
            return response()->json([
                'title' => "Successfully Registered!",
                'icon' => "success",
                "user" => $user,
                "status" => 200
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed.',
                'errors' => $e->errors(),
                'status' => 422,
                'title' => "Error Occured!",
                'icon' => "error",
            ]);
        }
    }

    public function registerSeller(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'fname' => "required|string|max:255",
                'lname' => "required|string|max:255",
                'gender' => "required|string",
                'dob' => "required|date",
                'phoneNumber' => "required|min:11|max:11|unique:users",
                'email' => "required|email|unique:users",
                "filePath" => "required|image|mimes:jpeg,png,jpg",
                'password' => "required|min:6",
                'role' => "required|string",
            ]);

            $path = Storage::putFile('public/users/seller', $request->file('filePath'));
            $path = asset("storage/" . substr($path, 7));
            $validatedData['filePath'] = $path;

            $user = User::create($validatedData);

            $verifyUser = VerifyUser::create([
                'token' => Str::random(60),
                'user_id' => $user->id,
            ]);

            Mail::to($user->email)->send(new ConfirmMail($user));
            return response()->json([
                'title' => "Successfully Registered!",
                'icon' => "success",
                "user" => $user,
                'validatedData' => $validatedData,
                "status" => 200
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'error' => 'Validation failed.',
                'errors' => $e->errors(),
                'status' => 422,
                'title' => "Error Occured!",
                'icon' => "error",
            ]);
        }
    }

    public function checkEmail(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            return response()->json(false);
        } else {
            return response()->json(true);
        }
    }

    public function checkPhoneNumber(Request $request)
    {
        $user = User::where("phoneNumber", $request->phoneNumber)->first();
        if ($user) {
            echo "false";
        } else {
            echo "true";
        }
    }

    public function showAdmin(string $id)
    {
        $user = User::FindOrFail($id);
        return view("admin.profile", compact("user"));
    }

    public function showSeller(string $id)
    {
        $user = User::FindOrFail($id);
        return view("seller.profile", compact("user"));
    }


    public function showCustomer(string $id)
    {
        $user = User::FindOrFail($id);
        return view("customer.profile", compact("user"));
    }

    public function sellerUpdatePassword(Request $request)
    {
        $validatedData = $request->validate([
            "new_password" => "required|string|min:6",
            "confirm_password" => "required|string|min:6|same:new_password",
            "user_id" => "required",
        ]);

        $user = User::FindOrFail($validatedData['user_id']);
        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        return redirect()->route('showSeller', ['id' => $user->id])->with(['text' => 'Password updated successfully!', "title" => "Hooray!", "icon" => "success"]);
    }

    public function updateSellerAcc(Request $request)
    {
        $validatedData = $request->validate([
            "fname" => "required|string|max:255",
            'lname' => "required|string|max:255",
            'gender' => "required|string|max:5",
            'dob' => "required|date",
            'email' => "required|email|unique:users, " . $request->user_id,
            'phoneNumber' => "required|min:11|max:11|unique:users, " . $request->user_id,

        ]);

        $user = User::FindOrFail($request->user_id)->first();
        $user->update($validatedData);

        return redirect()->route('showSeller', ['id' => $user->id])->with(['text' => 'Profile updated successfully!', "title" => "Hooray!", "icon" => "success"]);
    }

    public function adminChangePass(Request $request)
    {
        $validatedData = $request->validate([
            "new_password" => "required|string|min:6",
            "confirm_password" => "required|string|min:6|same:new_password",
            "user_id" => "required",
        ]);

        $user = User::FindOrFail($validatedData['user_id']);
        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        return redirect()->route('admin.profile', ['id' => $user->id])->with(['text' => 'Password updated successfully!', "title" => "Hooray!", "icon" => "success"]);
    }

    public function adminChangeProfile(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|string|max:5',
            'dob' => 'required|date',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'phoneNumber' => [
                'required',
                'min:11',
                'max:11',
                Rule::unique('users')->ignore($id),
            ],
            'address' => 'required|string',
        ]);

        if ($request->hasFile('profilePicture')) {
            $path = Storage::putFile('public/users/admin', $request->file('profilePicture'));
            $path = asset('storage/' . substr($path, 7));
            $validatedData['filePath'] = $path;
        }

        $user = User::findOrFail($request->user_id);
        $user->update($validatedData);

        return response()->json([
            "user" => $user,
            "status" => 200,

        ]);
    }

    public function checkEmailUpdate(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'id' => "required",
        ]);

        $email = $request->input('email');
        $id = $request->input("id");
        $exists = User::where('email', $email)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return response()->json(false);
        }

        return response()->json(true);
    }

    public function checkPhoneNumberUpdate(Request $request)
    {
        $request->validate([
            'phoneNumber' => 'required|min:11|max:11',
            'id' => "required",
        ]);

        $phoneNumber = $request->input("phoneNumber");
        $id = $request->input("id");
        $exists = User::where('phoneNumber', $phoneNumber)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return response()->json(false);
        }

        return response()->json(true);
    }

    public function updateCustomer(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|string|max:5',
            'dob' => 'required|date',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'phoneNumber' => [
                'required',
                'min:11',
                'max:11',
                Rule::unique('users')->ignore($id),
            ],
            'address' => 'required|string',
        ]);

        if ($request->hasFile('profilePicture')) {
            $path = Storage::putFile('public/users/admin', $request->file('profilePicture'));
            $path = asset('storage/' . substr($path, 7));
            $validatedData['filePath'] = $path;
        }

        $user = User::findOrFail($request->user_id);
        $user->update($validatedData);

        return response()->json([
            "user" => $user,
            "status" => 200,

        ]);
    }

    public function updateSeller(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'gender' => 'required|string|max:5',
            'dob' => 'required|date',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($id),
            ],
            'phoneNumber' => [
                'required',
                'min:11',
                'max:11',
                Rule::unique('users')->ignore($id),
            ],
        ]);

        if ($request->hasFile('profilePicture')) {
            $path = Storage::putFile('public/users/admin', $request->file('profilePicture'));
            $path = asset('storage/' . substr($path, 7));
            $validatedData['filePath'] = $path;
        }

        $user = User::findOrFail($request->user_id);
        $user->update($validatedData);

        return response()->json([
            "user" => $user,
            "status" => 200,

        ]);
    }

    public function generateReport()
    {
        // Fetch users from the database
        $users = User::all();

        // Load the view and pass the users data
        $pdf = PDF::loadView('admin.report.usersReport', compact('users'));

        // Download the PDF file
        return $pdf->download('users_list.pdf');
    }
}
