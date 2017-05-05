<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    //public function index(Category $category)
    public function index()
    {
        //$feeds = $category->feeds;
        $user = Auth::user();

        $categories = $user->categories()->latest()->get();

        //$this->authorize('update', $categories);

        return view('category.index', compact('categories'));
    }


    public function store(CategoryRequest $request)

    {
        $user = Auth::user();
        $user->categories()->create([
            'name' => $request->input('name')
        ]);

        return back()->withSuccess(__('Category successfully created!'));

    }


    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }


    public function create()
    {
        return view('category.create');
    }


    public function edit(Category $category)
    {
        $this->authorize('update', $category);

        return view('category.edit', compact('category'));
    }


    public function update(CategoryRequest $request, Category $category)
    {
        $this->authorize('update', $category);

        $category->update($request->only(['name']));

        return redirect()->route('category.show', $category)->withSuccess(__('Post successfully updated!'));
    }


    public function destroy(Category $category)
    {
        $this->authorize('update', $category);

        $category->feeds()->detach();

        $category->delete();

        return back()->withSuccess(__('Category successfully deleted!'));
    }


}
