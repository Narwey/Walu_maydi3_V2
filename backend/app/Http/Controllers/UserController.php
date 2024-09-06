<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:10',
            'email' => 'required|email',
            'password' => ['required', Password::min(10)],
            'role' => 'required'
        ]);

        $user = User::create($validatedData);

        return response()->json($user);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $user = User::find($id);

       if(!$user) {
            return response()->json(['user is not found']);
       }

            return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $validatedData = $request->validate([
            'name' => 'required|string|max:10',
            'email' => 'required|email|',
            'password' => ['required', Password::min(10)],
       ]);

       $user = User::findOrFail($id);

       $user->update($validatedData);

       return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        if(!$user) {
            return response()->json(['User does not exist']);
        }

        return response()->json(['message' => 'user deleted successfully'] , 200);
    }
}
