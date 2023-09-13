<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use \stdClass;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' =>  'required|string|email|max:255|unique:users',
            'password' => 'required|string| min:8',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'description' => $request->description
        ]);


        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['data' => $user, 'access_token' => $token, 'token_type' => 'Bearer',]);
    }

    public function login(Request $request)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Hi again ' . $user->name . "!",
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,

        ]);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return ['message' => 'you have succesfully logged out and the tokens was succesfully deleted'];
    }

    public function me(Request $request)
    {

        /* $user = User::where('email', $request['email'])->firstOrFail(); */
        $user = User::where('email', $request['email'])->first();
        return response()->json([
            'name' => '' . $user->name,
            'email' => '' . $user->email,
            'description' => '' . $user->description,

        ]);

       
    }
}
