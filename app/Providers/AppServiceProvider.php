<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Project;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Share variable $data_project ke semua view
        View::composer('*', function ($view) {
            $view->with('data_project', Project::all());
        });
    }
}

