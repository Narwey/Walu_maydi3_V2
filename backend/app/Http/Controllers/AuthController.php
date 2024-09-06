<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:10',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user = User::create($validatedData);
        $token = $user->createToken($request->name);

        return [
            'user' => $user ,
            'token' => $token->plainTextToken
        ];
    }

    public function login(Request $request) {
        $request->validate(
            [
            'email' => 'required|email|exists:users',
            'password' => 'required'
            ]
            );

        $user = User::where('email' , $request->email)->first();

        if(!$user || !Hash::check($request->password , $user->password)) {
                return 'credentials are not correct';
        }
        $token = $user->createToken($user->name);

        return [
            'user' => $user ,
            'token' => $token->plainTextToken
        ];

    }

    public function logout(Request $request) {

        $request->user()->currentAccessToken()->delete();

        return ["message" => "you are logged out"] ;
    }
}
