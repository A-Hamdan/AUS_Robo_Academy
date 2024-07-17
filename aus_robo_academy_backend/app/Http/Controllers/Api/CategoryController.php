<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Models\User;
use App\Models\UserCategory;
use App\Http\Requests\Api\GetCategoryRequest;

class CategoryController extends Controller
{
    public function index() {

        $category = Category::where([
            'type' => 'program',
            'is_active' => true
        ])
        ->get();
        return CategoryResource::collection($category);
    }

    public function getProgramCategory(GetCategoryRequest $request) {

        $user = User::where('organisation_id', $request->organisation_id)->first();

        if (!$user)
            return response()->json(['message' => 'Invalid organization ID'], 400);

        $categories = Category::where([
            'type' => 'program',
            'is_active' => true
        ])
        ->get();

        $userCategories = UserCategory::where('user_id', $user->id)->pluck('category_id')->toArray();

        $programs = $categories->map(function ($category) use ($userCategories) {
            $category->enabled = in_array($category->id, $userCategories);
            return $category;
        });

        return CategoryResource::collection($programs);
    }

    public function getVideoCategory() {
        $categories = Category::where([
            'type' => 'video',
            'is_active' => true
        ])
        ->get();
        return CategoryResource::collection($categories);
    }

    public function getUserCategories() {
        $programs = User::with('categories')->where('id',auth()->user()->id)->first()->categories;
        return CategoryResource::collection($programs);
    }
}
