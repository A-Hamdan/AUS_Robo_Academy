<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Models;
use Spatie\Permission\Models\Role;
use Khsing\World\World;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('programs', Category::where('type','program')->where('is_active',true)->get());
        View::share('categories', Category::where('type','video')->where('is_active',true)->get());
        View::share('roles', Role::all());
        View::share('countries', DB::table('world_countries')->orderBy('name','asc')->get());
        View::share('states', DB::table('world_divisions')->get());
        View::share('cities', DB::table('world_cities')->get());
    }
}
