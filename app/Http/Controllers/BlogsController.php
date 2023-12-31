<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Course;
use App\Models\Movie;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Session;

use Illuminate\Pagination\Paginator;

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
        // Fetch the latest 10 blogs
        $blogs = Blog::where('status', 1)->latest()->paginate(6);

        // Fetch the latest 10 courses
        $courses = Course::latest()->paginate(8);

        // Fetch the latest 10 movies
        $movies = Movie::latest()->paginate(6);

        Paginator::useBootstrap();

        // You can also fetch other data like categories, most viewed blogs, etc., as needed.
        $categories = Category::all();
        // $mostViewedBlogs = Blog::orderBy('view_count', 'desc')->take(3)->get();

        // Return the data to the view
        return view('blogs.index', compact('blogs', 'courses', 'movies', 'categories'));
    }

    public function bindex()
    {
        $blogs = Blog::where('status', 1)->latest()->paginate(10);
        Paginator::useBootstrap();
        $categories = Category::all();
        $mostViewedBlogs = Blog::orderBy('view_count', 'desc')->take(3)->get();
        return view('blogs.bindex', compact('blogs', 'categories', 'mostViewedBlogs'));
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

        $isAdmin = $request->user()->role_id === 1;
        if ($isAdmin) {
            $input['status'] = 1;
        } else {
            $input['status'] = 0;
        }

        $blogByUser = $request->user()->blogs()->create($input);


        if ($request->category_id) {
            $blogByUser->category()->sync($request->category_id);
        }

        $isAdmin = $request->user()->role_id === 1;
        if ($isAdmin) {
            Session::flash('success', 'Congratulations on creating a great Blog!');
        } else {
            Session::flash('success', 'Be patient !! Your Blog will be Live Soon. ');
        }

        return redirect('/blogs');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id, string $slug)
    {
        $blogshow = Blog::all();
        $blog = Blog::where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();
        $categories = Category::all();
        return view('blogs.show', compact('blog', 'categories', 'blogshow'));
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

        // Check if the currently authenticated user is the author or an admin
        if (auth()->user()->isAdmin() || auth()->user()->id === $blog->user_id) {
            $bc = $blog->category->pluck('id')->all();
            $filtered = $categories->whereNotIn('id', $bc);

            return view('blogs.edit', compact('blog', 'categories', 'filtered'));
        } else {
            Session::flash('error', 'You do not permission to edit this!');
            // Handle unauthorized access here, e.g., redirect or show an error message
            return redirect()->route('blogs.bindex');
        }
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $input = $request->all();
        $blog = Blog::findOrFail($id);

        $rules = [
            "title" => ["required", 'min:20', "max:160"],
            "body" => ["required", 'min:100'],
        ];
        $this->validate($request, $rules);

        $input['slug'] = Str::slug($request->title);
        $input['meta_title'] = Str::limit($request->title, 55);
        $input['meta_description'] = Str::limit($request->body, 150);

        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            $extension = $image->getClientOriginalExtension();
            $imageName = 'featured_image_' . time() . '.' . $extension;
            $image->move(public_path('images/featured_image'), $imageName);
            $input['featured_image'] = 'images/featured_image/' . $imageName;

            // If there was a previous featured image, delete it
            if ($blog->featured_image) {
                // Assuming 'images/featured_image' is the directory where images are stored
                $imagePath = public_path($blog->featured_image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        }

        if ($request->input('status') === '0') {
            // Save as Draft
            $input['status'] = 0;
        } elseif ($request->input('status') === '1') {
            // Save as Published
            $input['status'] = 1;
        }

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
            return redirect()->route('blogs.trash')->with('success', 'Blog post permanently deleted.');
        }
        return redirect()->route('blogs.trash')->with('message', 'Blog post not found.');
    }


    public function toggleStatus(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        // Toggle the status between 0 and 1
        $newStatus = ($blog->status == 0) ? 1 : 0;

        // Update the status
        $blog->update(['status' => $newStatus]);

        // Redirect back to the admin page
        return redirect()->route('admin.blogs');
    }

    public function search(Request $request)
    {
        // Get the search query from the request
        $searchQuery = $request->input('search');

        // get all blogs 
        $blogshow = Blog::all();

        // Get all categories
        $categories = Category::all();

        // Get most viewed blogs
        $mostViewedBlogs = Blog::orderBy('view_count', 'desc')->take(3)->get();

        // Search for blogs using the title or body
        $blogs = Blog::where('status', 1)
            ->where(function ($query) use ($searchQuery) {
                $query->where('title', 'like', '%' . $searchQuery . '%')
                    ->orWhere('body', 'like', '%' . $searchQuery . '%');
            })
            ->latest()
            ->paginate(6);

        Paginator::useBootstrap();

        // Check if there are no search results
        if ($blogs->isEmpty()) {
            // Get all blogs with pagination
            $blogs = Blog::where('status', 1)->latest()->paginate(10);
            return view('blogs.bindex', compact('blogs', 'categories', 'mostViewedBlogs'))
                ->with('message1', 'Search again with a valid keyword.');
        }

        return view('blogs.search', compact('blogs', 'categories', 'mostViewedBlogs', 'searchQuery', 'blogshow'));
    }


    public function allsearch(Request $request)
    {
        $searchQuery = $request->input('search');
        $categories = Category::all();

        // Search for blogs
        $blogResults = Blog::where('status', 1)
            ->where(function ($query) use ($searchQuery) {
                $query->where('title', 'like', '%' . $searchQuery . '%')
                    ->orWhere('body', 'like', '%' . $searchQuery . '%');
            })
            ->get();

        // Search for movies
        $movieResults = Movie::where('title', 'like', '%' . $searchQuery . '%')
            ->get();

        // Search for courses
        $courseResults = Course::where('title', 'like', '%' . $searchQuery . '%')
            ->orWhere('body', 'like', '%' . $searchQuery . '%')
            ->orWhere('instructor', 'like', '%' . $searchQuery . '%')
            ->orWhere('course_author', 'like', '%' . $searchQuery . '%')
            ->get();

        // Combine the results from all three models
        $results = [
            'blogs' => $blogResults,
            'movies' => $movieResults,
            'courses' => $courseResults,
        ];

        return view('blogs.allsearch', compact('results', 'searchQuery', 'categories'));
    }


}