<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Pagination\Paginator;
use App\Models\Movie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MovieController extends Controller
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
        // Paginate the movies with a specified number of items per page (e.g., 10 per page).
        $movies = Movie::latest()->paginate(18); // You can adjust the number as needed.
        $allmovie = Movie::all();
        Paginator::useBootstrap();
        return view('movies.index', compact('movies', 'allmovie'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $rules = [
            "title" => ["required", 'min:5', "max:160"],
            "body" => ["required", 'max:500'],
            "year" => ["required", 'min:4'],
            "actors" => ["required"],
            "producer" => ["required"],
            "link" => ["required"],
        ];
        $this->validate($request, $rules);

        $input = $request->all();

        $input['slug'] = Str::slug($request->title);
        $input['meta_title'] = Str::limit($request->title, 55);
        $input['meta_description'] = Str::limit($request->body, 150);

        // Handle file upload (if an image was provided)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $imageName = 'movie_image_' . time() . '.' . $extension;
            $image->move(public_path('images/movie_image'), $imageName);
            $input['image'] = 'images/movie_image/' . $imageName;
        }

        // Create a new movie instance
        $movie = new Movie($input);

        // Associate the movie with the authenticated user
        $movie->user_id = Auth::id();

        // Save the movie to the database
        $movie->save();

        // Flash a success message to the session
        Session::flash('success', 'Congratulations on creating a movie!');

        // Redirect to a success page or return a response
        return redirect('/movies');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Find the movie by its ID
        $movies = Movie::find($id);
        $allmovies = Movie::all();
        // Check if the movie exists
        if (!$movies) {
            // Handle the case where the movie does not exist, e.g., show an error page or redirect
            return redirect('/movies')->with('error', 'Movie not found');
        }
        // Load the view to display the movie details
        return view('movies.show', ['movie' => $movies], ['allmovie' => $allmovies]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $slug)
    {
        $movies = Movie::where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();
        if (auth()->user()->isAdmin() || auth()->user()->id === $movies->user_id) {
            return view('movies.edit', compact('movies'));
        } else {
            // Handle unauthorized access here, e.g., redirect or show an error message
            Session::flash('error', 'You do not permission to edit this!');
            return redirect()->route('movies.index');
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $rules = [
            "title" => ["required", 'min:5', "max:160"],
            "body" => ["required", 'max:500'],
            "year" => ["required", 'min:4'],
            "actors" => ["required"],
            "producer" => ["required"],
            "link" => ["required"],
        ];
        $this->validate($request, $rules);

        // Find the movie to be updated
        $movie = Movie::findOrFail($id);

        $input = $request->all();

        $input['slug'] = Str::slug($request->title);
        $input['meta_title'] = Str::limit($request->title, 55);
        $input['meta_description'] = Str::limit($request->body, 150);

        // Handle file upload (if an image was provided)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $imageName = 'movie_image_' . time() . '.' . $extension;
            $image->move(public_path('images/movie_image'), $imageName);
            $input['image'] = 'images/movie_image/' . $imageName;

            // Delete the previous image file if it exists
            if (File::exists(public_path($movie->image))) {
                File::delete(public_path($movie->image));
            }
        }

        // Update the movie attributes
        $movie->update($input);

        // Flash a success message to the session
        Session::flash('success', 'Movie updated successfully!');

        // Redirect to a success page or return a response
        return redirect('/movies');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $movie = Movie::findOrFail($id); // Find the specific Movie model instance
        $movie->delete(); // Delete the model
        // You can add a success message or redirect to a new page
        return redirect('/movies');
    }
    public function trash()
    {
        $trashedmovie = Movie::onlyTrashed()->get(); # get all tr
        return view("movies.trash", compact("trashedmovie"));

    }
    public function restore($id, $slug)
    {
        $restoredmovie = Movie::onlyTrashed()
            ->where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();

        if ($restoredmovie) {
            $restoredmovie->restore();
            return redirect('/')->with('success', 'Movie post restored successfully.');
        }

        return redirect('/')->with('message', 'The trash is empty.');
    }


    public function parmanentDelete($id, $slug)
    {
        $deletedmovie = Movie::onlyTrashed()
            ->where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();

        if ($deletedmovie) {
            $deletedmovie->forceDelete();
            return redirect()->route('movies.trash')->with('success', 'Movie post permanently deleted.');
        }
        return redirect()->route('movies.trash')->with('message', 'Movie post not found.');
    }


    public function incrementDownloadCount(Movie $movie)
    {
        $movie->increment('download_count');
        // You can return a response if needed
        return response()->json(['message' => 'Download count incremented successfully']);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $allmovie = Movie::all();

        // Perform the search using a case-insensitive "like" query
        $movies = Movie::where('title', 'like', '%' . $query . '%')
            ->paginate(18); // You can adjust the pagination settings

        if ($movies->isEmpty()) {
            // Get all blogs with pagination
            $movies = Movie::latest()->paginate(18);
            return view('movies.index', compact('movies'))
                ->with('message1', 'Search again with a valid keyword.');
        }

        return view('movies.search', compact('movies', 'query', 'allmovie'));
    }

}