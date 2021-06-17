<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        //
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
