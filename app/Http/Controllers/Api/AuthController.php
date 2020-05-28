<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Profile;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required|confirmed'
        ]);

        $validatedData['password'] = bcrypt($request->password);
        $user = User::create($validatedData);
        try {
            // create necessary records
            $profile = Profile::create(['user_id' => $user->id]);
            $jobHistory = JobHistory::create(['user_id' => $user->id]);
        } catch (\Exception $e) {
            return response(['message' => $e->getMessage()], $e->getCode());
        }

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'user' => $user,
            'access_token' => $accessToken,
            'message' => 'Registered successfully'
        ], 200);
    }

    public function local()
    {
        return response()->json(['user' => auth()->user()]);
    }

    public function oauth()
    {
        return response()->json(auth()->user());
    }
}
