<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlogsController::class, 'index'])->name('blogs.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/blogs/create', [BlogsController::class, 'create'])->name('blogs.create');
    Route::post('/blogs/store', [BlogsController::class, 'store'])->name('blogs.store');
    Route::get('/blogs', [BlogsController::class, 'index'])->name('blogs.index');

    // keep trashed routes 
    Route::get('/blogs/trash', [BlogsController::class, 'trash'])->name('blogs.trash');
    Route::get('/blogs/trash/{id}/restore', [BlogsController::class, 'restore'])->name('blogs.restore');
    Route::get('/blogs/trash/{id}/parmanent-delete', [BlogsController::class, 'parmanentDelete'])->name('blogs.parmanent-delete');



    Route::get('/blogs/{id}', [BlogsController::class, 'show'])->name('blogs.show');
    Route::get('/blogs/{id}/edit', [BlogsController::class, 'edit'])->name('blogs.edit');
    Route::post('/blogs/{id}/update', [BlogsController::class, 'update'])->name('blogs.update');
    Route::post('/blogs/{id}/destroy', [BlogsController::class, 'destroy'])->name('blogs.destroy');
});


require __DIR__ . '/auth.php';