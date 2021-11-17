<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all()->pluck('name');
        $users = User::withTrashed()->paginate(10);
        return view('admin.user.index', compact('roles', 'users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        if ($user->id === 1)
            return back()->with('user', $user)
                ->with('role', 'This user`s role can`t change');

        if (auth()->user()->hasRole(['super_admin', 'admin']))
            $user->syncRoles($request->role);
        return back()->with('user', $user)
            ->with('role', 'Role assigned');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id === 1)
            return back()->with('user', $user)
                ->with('delete', 'This user can`t being deactivated');


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
