<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Project;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /* Constructor dijalankan setiap request */
    public function __construct()
    {
        // Cache 1 jam supaya query tidak dieksekusi terus-menerus
        $projects = Cache::remember('sidebar_projects', 3600, function () {
            return Project::select('id', 'nama')->get();
        });

        // Share ke seluruh view
        View::share('data_project', $projects);
    }
}
