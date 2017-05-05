<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UsersRequest;
use App\User;


class UsersController extends Controller
{

    /**
     * Display the specified resource.
     */

    public function show(Request $request, User $user)
    {
        $posts = $user->posts()->get();


        return view('users.show')->with([
            'user' => $user,
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(Request $request, User $user)
    {
        $this->authorize('update', $user);

        return view('users.edit', $user)->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, User $user)
    {

        $this->authorize('update', $user);


        $this->validate($request, [
            'old_password' => 'required|old_password:' . $user->password,
            'password' => 'required|min:6|confirmed',
        ]);

        $credentials = $request->only('password');


        $user->password = bcrypt($credentials['password']);

        $user->save();

        return redirect()->route('users.show', $user)->withSuccess(__('users.updated'));
    }

}
