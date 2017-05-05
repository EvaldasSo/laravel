<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeedsRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Feed;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Category;


class FeedController extends Controller
{


    // Need a re-work id:2
    public function index() {

        $user = Auth::user();
        $feeds = $user->feeds()->latest()->paginate(10);

        $categories = $user->categories()->has('feeds')->pluck('name');

        return view('feed.index', compact('feeds', 'categories'));

    }

    // Need a re-work id:2
    public function indexByCategory(Category $category)
    {

        $feeds = $category->feeds()->latest()->get();

        $user = Auth::user();

        $categories = $user->categories()->has('feeds')->pluck('name');

        return view('feed.index', compact('feeds', 'categories'));

    }

    public function create()
    {

        $user = Auth::user();

        $categories = $user->categories()->get();

        return view('feed.create', compact('categories'));
    }

    public function show(Feed $feed)
    {
        return view('feed.show', compact('feed'));
    }

 
    public function store(FeedsRequest $request)
    {

        $user = Auth::user();

        $feed = $user->feeds()->create([
                'feed_url' => $request->input('feed_url')
        ]);

        if( ! is_null($request->input('category')))
        {

            $this->attachCategories($feed, $request->input('category'));
        }

        return back()->withSuccess(__('Feed successfully created!'));
    }

    // This looks really good, need a re-work id:1

    protected function attachCategories (Feed $feed, array $selectedCategories = null)
    {

        $feed = \App\Feed::find($feed->id);

        $categories = \App\Category::pluck('id', 'name')->toArray();

        $categoriesIds = [];

        foreach($categories as $categoryName => $category)
        {
            if (in_array($categoryName, $selectedCategories)) {
                $categoriesIds[] = $category;
            }
        }

        $feed->category()->attach($categoriesIds);
    }

    // Need a re-work id:1 , workaround on workaround
    protected function detach_categories(Feed $feed, array $selectedCategories = null){

        $feed->category()->detach();

        if( ! is_null($selectedCategories))
        {
            $this->attachCategories($feed, $selectedCategories);
        }

    }


    public function edit(Feed $feed)
    {
        $this->authorize('update', $feed);

        $categories = Category::all();

        $selectedCategories = $feed->category->pluck('name');

        return view('feed.edit', compact('feed', 'categories', 'selectedCategories'));
    }


    public function update(FeedsRequest $request, Feed $feed)
    {
        $this->authorize('update', $feed);

        $feed->update($request->only(['name']));

        // Need validation input of category
        $this->detach_categories($feed, $request->input('category'));

        return redirect()->route('feed.show', $feed)->withSuccess(__('Feed successfully updated!'));
    }


    public function destroy(Feed $feed)
    {
        $this->authorize('update', $feed);

        $feed->category()->detach();

        $feed->delete();

        return back()->withSuccess(__('Feed successfully deleted!'));
    }




























































}
