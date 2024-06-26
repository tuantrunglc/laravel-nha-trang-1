<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('PersonalAccess')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password])) {
            $user = Auth::user();
            if ($user->is_blocked) {
                return response()->json(['message' => 'Tài khoản của bạn đã bị khóa'], 401);
            }

            $token = $user->createToken('PersonalAccess')->plainTextToken;

            return response()->json(['user' => $user, 'token' => $token], 200);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

    }
    public function update(Request $request)
    {
        $user = Auth::user(); // Lấy người dùng đang đăng nhập

        $validatedData = $request->validate([
            'email' => 'required|email|unique:users,email,' . $user->id,
            'address' => 'required|string',
            'contact_phone' => 'required|string',
            'recipient_name' => 'required|string'
        ]);

        $user->update($validatedData);

        return response()->json(['message' => 'User updated successfully.', 'user' => $user]);
    }
}
