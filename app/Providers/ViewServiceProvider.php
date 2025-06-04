<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer(['client.layout.header'], function ($view) {
            $currentUrl = $_SERVER['REQUEST_URI'];
            $categories = Category::with('subCategories')->orderBy('name','asc')->get();
            $view->with([
                'categories' => $categories,
                'currentUrl' => $currentUrl
            ]);
        });
    }
}
