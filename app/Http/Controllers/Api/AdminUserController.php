<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\AdminUser;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AdminUser::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin_user = new AdminUser;
        $admin_user->fill(array_merge(
            $request->all(), ['password' => Hash::make($request->password)]
        ))->save();
        return $admin_user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin_user = AdminUser::find($id);
        $admin_user->fill(array_merge(
            $request->all(), ['password' => Hash::make($request->password)]
        ))->save();
        return $admin_user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin_user = AdminUser::find($id);
        $admin_user->delete();
        return $admin_user;
    }
}
