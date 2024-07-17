<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\ProductType;
use App\Models\CategoryType;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\UserCategory;
use Validator;

class CategoryController extends Controller
{
    public function index() {
        if(request()->segment(1) == 'programs') {
            if(auth()->user()->hasRole(['super-admin','admin'])) {
                $categories = Category::where('type','program')->get();
            }else {
                $categoryId = UserCategory::where('user_id', auth()->user()->id)->pluck('category_id')->toArray();
                $categories = Category::whereIn('id',$categoryId)
                ->where('is_active',true)
                ->get();
            }
        }else {
            if(auth()->user()->hasRole(['super-admin','admin'])) {
                $categories = Category::where('type','video')->get();
            }else {
                $categories = Category::where('type','video')
                ->where('is_active',true)
                ->get();
            }
        }

        $title = request()->segment(1) == 'programs' ? 'Programs' : 'Video Categories';
        return view('backend.categories.list', compact('title','categories'));
    }

    public function show(Category $category) {
        return $category;
    }

    public function create() {
        $title = request()->segment(1) == 'programs' ? 'Create Programs' : 'Create Video Category';
        return view('backend.categories.form', compact('title'));
    }

    public function store(StoreCategoryRequest $request) {
        $image = $request->file('image')->store('admin/categories/'. $request->type, 'public');

        $category = Category::create([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'description' => $request->description,
            'from_age' => $request->from_age,
            'to_age' => $request->to_age,
            'type' => $request->type,
            'image' => 'storage/'.$image,
        ]);
        return redirect()->route($request->type == 'program' ? 'programs.index' : 'video.categories.index')->with('success', $request->title .' has been added successfully.');
    }

    public function edit(Category $category) {
        $title = 'Update ' . $category->title;
        return view('backend.categories.form', compact('title','category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category) {
        if($request->has('image')) {
            $image = $request->file('image')->store('admin/categories/'. $category->type, 'public');
        }

        $category->update([
            'title' => $request->title,
            'sub_title' => $request->sub_title,
            'description' => $request->description,
            'from_age' => $request->from_age,
            'to_age' => $request->to_age,
            $request->has('image') ? 'image' : '' => $request->has('image') ? 'storage/'.$image : '',
        ]);
        return redirect()->route($category->type == 'program' ? 'programs.index' : 'video.categories.index')->with('success', $request->title .' has been updated successfully.');
    }

    public function status(Category $category) {
        $status = $category->is_active == 1 ? 0 : 1;
        $category->update(['is_active' => $status]);
        return back()->with('success', $status == 1 ? $category->title.' status has been changed to Enabled.' : $category->title. ' status has been changed to Disabled.');
    }

    public function destroy(Category $category) {
        if($category->model()->count() > 0 || $category->video()->count() > 0) {
            return redirect()->route($category->type == 'program' ? 'programs.index' : 'video.categories.index')->with('error', 'Cannot delete the record because it has related records.');
        }else {
            $category->delete();
            return back()->with('success', $category->title . ' has been deleted successfully.');
        }
    }

    public function getCategoriesByOrganisationId(Request $request) {

        $validator = Validator::make($request->all(), [
            'organisation_id' => 'required|string',
        ]);

        if($validator->fails())
            return back()->with('error', 'Please enter your Organisation ID to proceed.');

        $user = User::where('organisation_id', $request->organisation_id)->first();

        if (!$user)
            return back()->with('error', 'The Organisation ID you entered is invalid.');
            session(['organisation_id' => $user->organisation_id]);

        $categories = Category::where([
            'type' => 'program',
            'is_active' => true
        ])
        ->get();


        $userCategories = UserCategory::where('user_id', $user->id)->pluck('category_id')->toArray();

        $programs = $categories->map(function ($categories) use ($userCategories) {
            $categories->enabled = in_array($categories->id, $userCategories);
            return $categories;
        });

        $title = "Programs";
        return view('backend.categories.student.list', compact('title','categories'));
    }
}
