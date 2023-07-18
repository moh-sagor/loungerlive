<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlogsController::class, 'index'])->name('blogs.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // admin routes 
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('admin');
    Route::get('/admin/blogs', [AdminController::class, 'blogs'])->name('admin.blogs');


    // Profile routes 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // keep trashed routes 
    Route::get('/blogs/trash', [BlogsController::class, 'trash'])->name('blogs.trash');
    Route::get('/blogs/trash/{id}/restore', [BlogsController::class, 'restore'])->name('blogs.restore');
    Route::get('/blogs/trash/{id}/parmanent-delete', [BlogsController::class, 'parmanentDelete'])->name('blogs.parmanent-delete');



    // blogs route 
    Route::get('/blogs/create', [BlogsController::class, 'create'])->name('blogs.create');
    Route::post('/blogs/store', [BlogsController::class, 'store'])->name('blogs.store');
    Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/{id}/edit', [BlogsController::class, 'edit'])->name('blogs.edit');
    Route::post('/blogs/{id}/update', [BlogsController::class, 'update'])->name('blogs.update');
    Route::post('/blogs/{id}/destroy', [BlogsController::class, 'destroy'])->name('blogs.destroy');

    // category route 
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/show/{slug}', [CategoryController::class, 'show'])->name('categories.show');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/edit/{slug}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/update/{slug}', [CategoryController::class, 'update'])->name('categories.update');
    Route::post('/categories/destroy/{slug}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});
Route::get('/blogs/{id}', [BlogsController::class, 'show'])->name('blogs.show');



require __DIR__ . '/auth.php';