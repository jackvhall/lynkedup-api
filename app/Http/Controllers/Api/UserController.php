<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return response([
            'users' => User::all(),
            'message' => 'success'
        ], 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
           'name' => 'required|max:55',
           'email' => 'email|required',
           'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Errors']);
        }

        $user = User::create($data);

        return response([
            'user' => $user,
            'profile' => $user->profile,
            'message' => 'Created successfully'
        ], 200);
    }

    public function update(Request $request, User $user)
    {
        if (isset($request->admin)) {
           $user->admin = $request->admin;
           $user->save();
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);
        return response([
            'message' => 'User successfully updated',
            'user' => $user
        ], 200);
    }
}
