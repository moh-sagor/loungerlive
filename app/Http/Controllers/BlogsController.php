<?php

namespace App\Http\Controllers;

use App\Models\Blog;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Session;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;

class BlogsController extends Controller
{

    public function __construct()
    {
        $this->middleware('author', ['only' => ['create', 'store', 'edit', 'update']]);
        $this->middleware('admin', ['only' => ['destroy', 'trash', 'restore', 'parmanentDelete']]);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::where('status', 1)->latest()->get();

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
        $rules = [
            "title" => ["required", 'min:20', "max:160"],
            "body" => ["required", 'min:100'],

        ];
        $this->validate($request, $rules);


        $input = $request->all();

        $input['slug'] = Str::slug($request->title);
        $input['meta_title'] = Str::limit($request->title, 55);
        $input['meta_description'] = Str::limit($request->body, 150);

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $extension = $image->getClientOriginalExtension();
            $imageName = 'featured_image_' . time() . '.' . $extension;
            $image->move(public_path('images/featured_image'), $imageName);
            $input['featured_image'] = 'images/featured_image/' . $imageName;
        }
        // $blog = Blog::create($validatedData);
        $blogByUser = $request->user()->blogs()->create($input);

        if ($request->category_id) {
            $blogByUser->category()->sync($request->category_id);
        }


        Session::flash('blog_created_message', 'Congratulations on creation a great Blog!');
        return redirect('/blogs');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id, string $slug)
    {
        $blog = Blog::where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();

        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */



    public function edit($id, $slug)
    {
        $categories = Category::latest()->get();
        $blog = Blog::where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();

        $bc = $blog->category->pluck('id')->all();
        $filtered = $categories->whereNotIn('id', $bc);

        return view('blogs.edit', compact('blog', 'categories', 'filtered'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $blog = Blog::findOrFail($id);
        $blog->update($input);

        if ($request->has('category_id')) {
            $categoryIds = $request->input('category_id');
            $blog->category()->sync($categoryIds);
        }

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

    public function restore($id, $slug)
    {
        $restoredBlog = Blog::onlyTrashed()
            ->where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();

        if ($restoredBlog) {
            $restoredBlog->restore();
            return redirect('/')->with('success', 'Blog post restored successfully.');
        }

        return redirect('/')->with('message', 'The trash is empty.');
    }


    public function parmanentDelete($id, $slug)
    {
        $deletedBlog = Blog::onlyTrashed()
            ->where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();

        if ($deletedBlog) {
            $deletedBlog->forceDelete();
            return view('blogs.trash')->with('success', 'Blog post permanently deleted.');
        }

        return view('blogs.trash')->with('message', 'Blog post not found.');
    }

}