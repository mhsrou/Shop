<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withTrashed()->paginate(10);
        return view('admin.user.index')->with('users', $users);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::find($user->id)->delete();

        return back()->with('user', $user)
            ->with('delete', 'user deactivated');
    }

    public function forceDelete($id)
    {
        User::withTrashed()->find($id)->forceDelete();

        return back();
    }

    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();

        return back();
    }
}
