<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\PostsRequest;
use App\Post;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest()->paginate(20);
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the rss feed of posts.
     *
     * @return Response
     */
    public function feed()
    {
        $posts = Cache::remember('feed-posts', 60, function () {
            return Post::latest()->limit(20)->get();
        });
        return response()->view('posts.feed', ['posts' => $posts], 200)->header('Content-Type', 'text/xml');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        $user = Auth::user();
        $post = $user->posts()->create([
            'title' => $request->input('title'),
            'content' => $request->input('content')

        ]);

        return redirect()->route('posts.show', $post)->with('success', __('posts.created'));
    }

    /**
     * Display the specified resource.
     */

    public function show(Post $post)
    {
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit')->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(PostsRequest $request, Post $post)
    {
        $this->authorize('update', $post);
        $post->update($request->only(['title', 'content']));

        return redirect()->route('posts.show', $post)->withSuccess(__('Post successfully updated!'));
    }

    /**
     * Remove the specified resource from storage
     *
     */
    public function destroy(Post $post)
    {
        $this->authorize('update', $post);

        $post->delete();

        return redirect('/')->withSuccess(__('Post successfully deleted!'));
    }
}
