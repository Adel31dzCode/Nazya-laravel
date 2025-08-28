<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\RefreshToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;

class AuthActionsController extends Controller
{
    // تسجيل مستخدم جديد
    public function register(Request $request)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'name' => 'required|string|min:4|max:22',
            'email' => 'required|string|email|max:255|unique:users',
            'number' => 'required|integer',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // إنشاء المستخدم
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'password' => Hash::make($request->password),
        ]);

        // إنشاء Access Token
        $accessToken = $user->createToken('auth_token')->plainTextToken;

        // إنشاء Refresh Token
        $refreshTokenPlain = bin2hex(random_bytes(40));
        $refreshTokenHashed = hash('sha256', $refreshTokenPlain);

        RefreshToken::create([
            'user_id' => $user->id,
            'token' => $refreshTokenHashed,
            'expires_at' => now()->addDays(30),
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'access_token' => $accessToken,
            'refresh_token' => $refreshTokenPlain,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 201);
    }

    // تسجيل الدخول
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // إنشاء Access Token
        $accessToken = $user->createToken('auth_token')->plainTextToken;

        // إنشاء Refresh Token
        $refreshTokenPlain = bin2hex(random_bytes(40));
        $refreshTokenHashed = hash('sha256', $refreshTokenPlain);

        RefreshToken::create([
            'user_id' => $user->id,
            'token' => $refreshTokenHashed,
            'expires_at' => now()->addDays(30),
        ]);

        return response()->json([
            'message' => 'Login successful',
            'access_token' => $accessToken,
            'refresh_token' => $refreshTokenPlain,
            'token_type' => 'Bearer',
            'user' => $user,
        ]);
    }

    // تجديد Access Token عبر Refresh Token
    public function refresh(Request $request)
    {
        $request->validate([
            'refresh_token' => 'required|string'
        ]);

        $hashedToken = hash('sha256', $request->refresh_token);

        $tokenData = RefreshToken::where('token', $hashedToken)
            ->where('expires_at', '>', now())
            ->first();

        if (!$tokenData) {
            return response()->json(['message' => 'Token invalide ou expiré.'], 401);
        }

        $user = $tokenData->user;

        $newAccessToken = $user->createToken('access-token')->plainTextToken;

        return response()->json([
            'access_token' => $newAccessToken,
            'token_type' => 'Bearer',
            'expires_in' => 900, // 15 دقيقة
        ]);
    }
}
