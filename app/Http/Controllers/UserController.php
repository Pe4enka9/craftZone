<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Регистрация
    public function register(RegisterRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        return response()->json([
            'user' => new UserResource($user),
            'token' => $user->createToken('auth')->plainTextToken,
        ], 201);
    }

    // Авторизация
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([], 401);
        }

        return response()->json([
            'user' => new UserResource($user),
            'token' => $user->createToken('auth')->plainTextToken,
        ]);
    }

    // Выход из системы
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(null, 204);
    }

    // Получение текущего пользователя
    public function getUser(Request $request): JsonResponse
    {
        return response()->json(new UserResource($request->user()));
    }
}
