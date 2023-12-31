<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Pagination\Paginator;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
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
        // Paginate the courses with a specified number of items per page (e.g., 10 per page).
        $courses = Course::latest()->paginate(18); // You can adjust the number as needed.
        $allcourse = Course::all();
        Paginator::useBootstrap();
        $categories = Category::all();
        return view('courses.index', compact('courses', 'allcourse', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
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
            "instructor" => ["required", 'min:5'],
            "course_author" => ["required", 'min:3'],
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
            $imageName = 'course_image_' . time() . '.' . $extension;
            $image->move(public_path('images/course_image'), $imageName);
            $input['image'] = 'images/course_image/' . $imageName;
        }

        // Create a new course instance
        $course = new Course($input);

        // Associate the course with the authenticated user
        $course->user_id = Auth::id();

        // Save the course to the database
        $course->save();

        // Flash a success message to the session
        Session::flash('success', 'Congratulations on creating a course!');

        // Redirect to a success page or return a response
        return redirect('/courses');
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Find the course by its ID
        $courses = Course::find($id);
        $allcourses = Course::all();
        $categories = Category::all();
        // Check if the course exists
        if (!$courses) {
            // Handle the case where the course does not exist, e.g., show an error page or redirect
            return redirect('/courses')->with('error', 'Course not found');
        }
        // Load the view to display the course details
        return view('courses.show', [
            'course' => $courses,
            'allcourse' => $allcourses,
            'categories' => $categories
        ]);

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $slug)
    {
        $courses = Course::where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();
        if (auth()->user()->isAdmin() || auth()->user()->id === $courses->user_id) {
            return view('courses.edit', compact('courses'));
        } else {
            // Handle unauthorized access here, e.g., redirect or show an error message
            Session::flash('error', 'You do not permission to edit this!');
            return redirect()->route('courses.index');
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
            "instructor" => ["required", 'min:5'],
            "course_author" => ["required", 'min:3'],
            "link" => ["required"],
        ];
        $this->validate($request, $rules);

        // Find the course to be updated
        $course = Course::findOrFail($id);

        $input = $request->all();

        $input['slug'] = Str::slug($request->title);
        $input['meta_title'] = Str::limit($request->title, 55);
        $input['meta_description'] = Str::limit($request->body, 150);

        // Handle file upload (if an image was provided)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $imageName = 'course_image_' . time() . '.' . $extension;
            $image->move(public_path('images/course_image'), $imageName);
            $input['image'] = 'images/course_image/' . $imageName;

            // Delete the previous image file if it exists
            if (File::exists(public_path($course->image))) {
                File::delete(public_path($course->image));
            }
        }

        // Update the course attributes
        $course->update($input);

        // Flash a success message to the session
        Session::flash('success', 'Course updated successfully!');

        // Redirect to a success page or return a response
        return redirect('/courses');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id); // Find the specific Course model instance
        $course->delete(); // Delete the model
        // You can add a success message or redirect to a new page
        return redirect('/courses');
    }
    public function trash()
    {
        $trashedCourse = Course::onlyTrashed()->get(); # get all tr
        return view("courses.trash", compact("trashedCourse"));

    }
    public function restore($id, $slug)
    {
        $restoredCourse = Course::onlyTrashed()
            ->where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();

        if ($restoredCourse) {
            $restoredCourse->restore();
            return redirect('/')->with('success', 'Course post restored successfully.');
        }

        return redirect('/')->with('message', 'The trash is empty.');
    }


    public function parmanentDelete($id, $slug)
    {
        $deletedCourse = Course::onlyTrashed()
            ->where('id', $id)
            ->where('slug', $slug)
            ->firstOrFail();

        if ($deletedCourse) {
            $deletedCourse->forceDelete();
            return redirect()->route('courses.trash')->with('success', 'Course post permanently deleted.');
        }
        return redirect()->route('courses.trash')->with('message', 'Course post not found.');
    }


    public function incrementDownloadCount(Course $course)
    {
        $course->increment('download_count');
        // You can return a response if needed
        return response()->json(['message' => 'Download count incremented successfully']);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $allcourse = Course::all();
        $categories = Category::all();

        // Perform the search using a case-insensitive "like" query
        $courses = Course::where('title', 'like', '%' . $query . '%')
            ->orWhere('body', 'like', '%' . $query . '%')
            ->orWhere('instructor', 'like', '%' . $query . '%')
            ->orWhere('course_author', 'like', '%' . $query . '%')
            ->paginate(18); // You can adjust the pagination settings

        if ($courses->isEmpty()) {
            // Get all blogs with pagination
            $courses = Course::latest()->paginate(18);
            $categories = Category::all();
            return view('courses.index', compact('courses', 'categories'))
                ->with('message1', 'Search again with a valid keyword.');
        }

        return view('courses.search', compact('courses', 'query', 'allcourse', 'categories'));
    }

}