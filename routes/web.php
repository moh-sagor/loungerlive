<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SocialloginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;



// public blogs 
Route::get('/', [BlogsController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{id}/{slug}', [BlogsController::class, 'show'])->name('blogs.show');
Route::get('/blogs/search', [BlogsController::class, 'search'])->name('blogs.search');
Route::get('/blogs/allsearch', [BlogsController::class, 'allsearch'])->name('blogs.allsearch');
Route::get('/blogs', [BlogsController::class, 'bindex'])->name('blogs.bindex');


// public categoires 
Route::get('/categories/show/{slug}', [CategoryController::class, 'show'])->name('categories.show');


// public users 
Route::get('/users/profile/{username?}', [UserController::class, 'show'])->name('users.show');
Route::get('/my/{username?}', [UserController::class, 'profile_show'])->name('users.profile_show');
Route::get('/users/profile/show/{username}/qrcode', 'UserController@showQrCode')->name('users.profile_qrcode');


// public comments 
Route::post('/blogs/{blog}/comments', [CommentsController::class, 'store'])->name('comments.store');

// public courses 
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{id}/{slug}', [CourseController::class, 'show'])->name('courses.show');
Route::post('/courses/increment-download-count/{course}', [CourseController::class, 'incrementDownloadCount']);
Route::get('/courses/search', [CourseController::class, 'search'])->name('courses.search');

// public movies 
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{id}/{slug}', [MovieController::class, 'show'])->name('movies.show');
Route::post('/movies/increment-download-count/{course}', [MovieController::class, 'incrementDownloadCount']);
Route::get('/movies/search', [MovieController::class, 'search'])->name('movies.search');


// google login
Route::get('/gotogoogle', [SocialloginController::class, 'gotogoogle'])->name('gotogoogle');
Route::get('/apigstore', [SocialloginController::class, 'apigstore'])->name('apigstore');




Route::middleware('auth', )->group(function () {

    // courses routes 
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{id}/{slug}/restore', [CourseController::class, 'restore'])->name('courses.restore');
    Route::get('/courses/{id}/{slug}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::post('/courses/{id}/update', [CourseController::class, 'update'])->name('courses.update');
    Route::post('/courses/{id}/destroy', [CourseController::class, 'destroy'])->name('courses.destroy');
    Route::get('/trashcourses', [CourseController::class, 'trash'])->name('courses.trash');
    Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{id}/{slug}/parmanent-delete', [CourseController::class, 'parmanentDelete'])->name('courses.parmanent-delete');
    // movies routes 
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies/store', [MovieController::class, 'store'])->name('movies.store');
    Route::get('/movies/{id}/{slug}/restore', [MovieController::class, 'restore'])->name('movies.restore');
    Route::get('/movies/{id}/{slug}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::post('/movies/{id}/update', [MovieController::class, 'update'])->name('movies.update');
    Route::post('/movies/{id}/destroy', [MovieController::class, 'destroy'])->name('movies.destroy');
    Route::get('/trashmovies', [MovieController::class, 'trash'])->name('movies.trash');
    Route::post('/movies/store', [MovieController::class, 'store'])->name('movies.store');
    Route::get('/movies/{id}/{slug}/parmanent-delete', [MovieController::class, 'parmanentDelete'])->name('movies.parmanent-delete');

    // admin routes 
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/confirm', [AdminController::class, 'confirm'])->name('admin.confirm');
    Route::get('/admin/blogs', [AdminController::class, 'blogs'])->name('admin.blogs');
    Route::post('/admin/blogs/{id}/toggle-status', [BlogsController::class, 'toggleStatus'])->name('blogs.toggle-status');


    // request for auth 
    Route::post('/send-email', [EmailController::class, 'sendEmail'])->name('emails.sendEmail');
    Route::get('/request/show', [EmailController::class, 'show'])->name('emails.show');
    Route::post('/update-status/{id}', [EmailController::class, 'updateStatus'])->name('emails.update-status');
    Route::post('/delete-request/{id}', [EmailController::class, 'destroy'])->name('emails.delete-request');



    // user dashboard 
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::post('/destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/edit/{username?}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');



    // Profile routes 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // keep trashed routes 
    Route::get('/trashblogs', [BlogsController::class, 'trash'])->name('blogs.trash');
    Route::post('/blogs/store', [BlogsController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{id}/{slug}/parmanent-delete', [BlogsController::class, 'parmanentDelete'])->name('blogs.parmanent-delete');


    // blogs route 
    Route::get('/createblogs', [BlogsController::class, 'create'])->name('blogs.create');
    Route::get('/blogs/{id}/{slug}/restore', [BlogsController::class, 'restore'])->name('blogs.restore');
    Route::get('/blogs/{id}/{slug}/edit', [BlogsController::class, 'edit'])->name('blogs.edit');
    Route::post('/blogs/{id}/update', [BlogsController::class, 'update'])->name('blogs.update');
    Route::post('/blogs/{id}/destroy', [BlogsController::class, 'destroy'])->name('blogs.destroy');

    // category route 
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/edit/{slug}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/update/{slug}', [CategoryController::class, 'update'])->name('categories.update');
    Route::post('/categories/destroy/{slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});




require __DIR__ . '/auth.php';