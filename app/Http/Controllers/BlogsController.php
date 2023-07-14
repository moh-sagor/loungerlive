<?php

namespace App\Http\Controllers;

use App\Models\Blog;

use App\Models\Category;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();

        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        Blog::create($validatedData);

        // You can add a success message or redirect to a new page
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->update($validatedData);

        // You can add a success message or redirect to a new page
        return redirect('/blogs');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id); // Find the specific Blog model instance
        $blog->delete(); // Delete the model
        // You can add a success message or redirect to a new page
        return redirect('/');
    }

    public function trash()
    {
        $trashedBlogs = Blog::onlyTrashed()->get(); # get all tr
        return view("blogs.trash", compact("trashedBlogs"));

    }

    public function restore($id)
    {
        $restoredBlog = Blog::onlyTrashed()->findOrFail($id);

        if ($restoredBlog) {
            $restoredBlog->restore();
            return redirect('/')->with('success', 'Blog post restored successfully.');
        }

        return redirect('/')->with('message', 'The trash is empty.');
    }

    public function parmanentDelete($id)
    {
        $deletedBlog = Blog::onlyTrashed()->findOrFail($id);

        if ($deletedBlog) {
            $deletedBlog->forceDelete();
            return redirect('/')->with('success', 'Blog post permanently deleted.');
        }

        return redirect('/')->with('message', 'Blog post not found.');
    }



}