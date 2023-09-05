<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create([
            'name' => $request['name'],
            'slug' => Str::slug($request['name'], '-'),
            'user_id' => auth()->id(), // set the user_id to the currently authenticated user's ID
        ]);

        // You can add a success message or redirect to a new page
        return back();
    }


    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('categories.show', compact('category'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $category = Category::where('slug', $slug)->first();
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $category = Category::findOrFail($slug);

        $category->update([
            'name' => $request['name'],
            'slug' => Str::slug($request['name'], '-'),
        ]);

        // You can add a success message or redirect to a new page
        return redirect('/categories');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $category = Category::where('slug', $slug)->first(); // Find the specific Blog model instance
        $category->delete(); // Delete the model
        // You can add a success message or redirect to a new page
        return redirect('/categories');
    }
}