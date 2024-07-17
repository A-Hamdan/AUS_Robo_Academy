<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Video;

class DashboardController extends Controller
{
    public function index() {

        $user = auth()->user();

        $totalUsers = User::whereHas("roles", function($roles) {
            $roles->where('name', 'admin');
        })->count();

        $totalTeachers = User::whereHas("roles", function($roles) {
            $roles->where('name', 'teacher');
        })->count();

        if ($user->hasRole('teacher')) {
            $totalPrograms = Category::whereHas('users', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->where('type', 'program')
                ->count();
        } else {
            $totalPrograms = Category::where('type', 'program')->count();
        }

        $totalVideos = Video::count();

        $categories = Category::all();
        $title = 'Dashboard';
        return view('backend.home.dashboard',compact('title','totalUsers','totalTeachers','totalPrograms','totalVideos','categories'));
    }
}
