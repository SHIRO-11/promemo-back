<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\AdminUser;

class AdminUserController extends Controller
{
    public function index()
    {
        return AdminUser::all();
    }


    public function store(Request $request)
    {
        $admin_user = new AdminUser;
        $admin_user->fill(array_merge(
            $request->all(),
            ['password' => Hash::make($request->password)]
        ))->save();
        return $admin_user;
    }


    public function update(Request $request, $id)
    {
        $admin_user = AdminUser::find($id);
        $admin_user->fill(array_merge(
            $request->all(),
            ['password' => Hash::make($request->password)]
        ))->save();
        return $admin_user;
    }


    public function destroy($id)
    {
        $admin_user = AdminUser::find($id);
        $admin_user->delete();
        return $admin_user;
    }
}
