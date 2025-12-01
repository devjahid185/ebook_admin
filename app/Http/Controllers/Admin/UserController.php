<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // ================== USER REGISTRATION ==================
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name"          => "required|string|max:255",
            "email"         => "required|email|unique:users,email",
            "phone"         => "nullable|unique:users,phone",
            "password"      => "required|min:6",
            "gender"        => "nullable|string",
            "date_of_birth" => "nullable|date",
            "address"       => "nullable|string",
            "profile_image" => "nullable|image|max:2048",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "errors" => $validator->errors()
            ], 422);
        }

        $path = null;
        if ($request->hasFile("profile_image")) {
            $path = $request->file("profile_image")->store("profiles", "public");
        }

        $user = User::create([
            "name"          => $request->name,
            "email"         => $request->email,
            "phone"         => $request->phone,
            "password"      => Hash::make($request->password),
            "gender"        => $request->gender,
            "date_of_birth" => $request->date_of_birth,
            "address"       => $request->address,
            "profile_image" => $path,
        ]);

        return response()->json([
            "status" => "success",
            "message" => "User registered successfully!",
            "user" => $user
        ]);
    }

    // ================== USER LOGIN ==================
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email"    => "required",
            "password" => "required",
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => "error",
                "errors" => $validator->errors()
            ], 422);
        }

        $user = User::where("email", $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "status" => "error",
                "message" => "Invalid email or password"
            ], 401);
        }

        return response()->json([
            "status" => "success",
            "message" => "Login successful",
            "user" => $user
        ]);
    }

    // ================== ADMIN CREATE USER ==================
    public function adminCreateUser(Request $request)
    {
        return $this->register($request);
    }
}
