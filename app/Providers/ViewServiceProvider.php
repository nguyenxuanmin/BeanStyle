<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Policy;
use App\Models\Instruct;

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
            $categories = Category::with('subCategories')->orderBy('name','asc')->get();
            $view->with([
                'categories' => $categories
            ]);
        });

        View::composer(['client.layout.footer'], function ($view) {
            $policies = Policy::orderBy('name','asc')->get();
            $instructs = Instruct::orderBy('name','asc')->get();
            $view->with([
                'policies' => $policies,
                'instructs' => $instructs
            ]);
        });
    }
}
