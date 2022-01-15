<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        $purchases = Purchase::where('user_id', $id)->get();
        return view('user.profile', compact('user', 'purchases'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit()
    {
        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        return view('user.edit', compact('user', $user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return bool|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request,User $user)
    {
        Validator::make($request->toArray(), [
            'name' => 'required',
            'phone' => ['required', 'regex:/^(\\+98|0)?9\\d{9}$/', 'unique:users'],
        ]);
        auth()->user()->update($request->all());

        return redirect()->route('profile.index')
            ->with('update', 'Your profile updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
