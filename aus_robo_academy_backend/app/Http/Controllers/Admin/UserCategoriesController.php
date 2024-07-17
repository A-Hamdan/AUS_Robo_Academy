<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCategory;

class UserCategoriesController extends Controller
{
    public function index(User $user) {
        $programs = User::with('categories')->where('id',$user->id)->first()->categories;
        $title = ucwords($user->name .' Programs');
        return view('backend.user_categories.list', compact('title','programs','user'));
    }

    public function create(User $user) {
        $title = 'Programs';
        return view('backend.user_categories.form', compact('title','user'));
    }

    public function store(Request $request) {
        $data = $request->all();
        if($request->category_id > 0) {
            foreach($request->category_id as $key => $value) {
                UserCategory::updateOrCreate([
                    'category_id' => $data['category_id'][$key],
                    'user_id' => $request->user_id,
                ],[
                    'user_id' => $request->user_id,
                    'category_id' => $data['category_id'][$key],
                ]);
            }
        }
        return redirect()->route('user.categories.index', $request->user_id)->with('success', 'Caategory has been assigned successfully.');
    }

    public function destroy(Request $request) {
        $userCategory = UserCategory::where(['user_id'=>$request->user_id,'category_id'=>$request->category_id]);
        $userCategory->delete();
        return back()->with('success', 'Assign category has been removed successfully.');
    }
}
