<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UsersRequest;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

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

    public function update(UsersRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $user->update($request->intersect(['name', 'email', 'password']));
        return redirect()->route('users.show', $user)->withSuccess(__('users.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
