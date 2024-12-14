<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create($request->validated());
            $user->address()->create($request->validated() + ['user_id' => $user->id]);

            // if ($request->has('image_url')) {
            //     $user->image()->create(['url' => $request->input('image_url')]);
            // }
        });
        return Response::success(message: 'User registered successfully');
    }
    public function login(LoginRequest $request)
    {
        $token = Auth::attempt($request->only('email', 'password'));
        if (! $token) {
            return Response::unauthorized("Invalid credentials");
        }
        return Response::success(['token' => $token, 'token_type' => "bearer", 'user' => $request->user()]);
    }

    public function logout()
    {
        Auth::logout();
        return Response::success(message: "Logged out successfully");
    }
    public function profile(Request $request)
    {
        return Response::success(['user' => $request->user()]);
    }
    public function refresh()
    {
        return Response::success(['token' => Auth::refresh()]);
    }
}
