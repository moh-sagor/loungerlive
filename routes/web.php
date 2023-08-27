<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\SocialloginController;
use Illuminate\Support\Facades\Route;




Route::get('/', [BlogsController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{id}/{slug}', [BlogsController::class, 'show'])->name('blogs.show');
Route::get('/categories/show/{slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/users/profile/{username?}', [UserController::class, 'show'])->name('users.show');
Route::get('/my/{username?}', [UserController::class, 'profile_show'])->name('users.profile_show');
Route::get('/blogs/search', [BlogsController::class, 'search'])->name('blogs.search');
Route::post('/blogs/{blog}/comments', [App\Http\Controllers\CommentsController::class, 'store'])->name('comments.store');


// google login
Route::get('/gotogoogle', [SocialloginController::class, 'gotogoogle'])->name('gotogoogle');
Route::get('/apigstore', [SocialloginController::class, 'apigstore'])->name('apigstore');




Route::middleware('auth', )->group(function () {

    // admin routes 
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
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
    Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs.index');
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