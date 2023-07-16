<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Blog;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer(['partials.meta_dynamic', 'layouts.nav'], function ($view) {
            $blogs = Blog::latest()->get(); // Retrieve all blog objects
            $view->with('blogs', $blogs);
        });
    }
}