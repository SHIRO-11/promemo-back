<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }


    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'user' => $user
        ]);
    }


    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    public function updateUserName(Request $request)
    {
        $auth = Auth::user();

        $auth->update([
            'name' => $request->name
        ]);

        return $auth;
    }

    public function updateUserEmail(Request $request)
    {
        $auth = Auth::user();

        $auth->update([
            'email' => $request->email
        ]);

        return $auth;
    }
}
