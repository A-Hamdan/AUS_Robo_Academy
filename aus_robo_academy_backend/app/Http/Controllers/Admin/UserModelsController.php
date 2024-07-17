<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Models;
use App\Models\UserModel;

class UserModelsController extends Controller
{
    public function index(Category $category, User $user) {

        $models = Models::whereHas('userModels', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })
        ->where('category_id', $category->id)
        ->get();

        $title = ucwords($user->name . ' Models');
        return view('backend.user_models.list', compact('title','models','category','user'));
    }

    public function create(Category $category, User $user) {
        $models = Models::where('category_id',$category->id)->get();
        $title = $category->title . ' Models';
        return view('backend.user_models.form', compact('title','models','user','category'));
    }

    public function store(Request $request) {
        $data = $request->all();
        if($request->models_id > 0) {
            foreach($request->models_id as $key => $value) {
                UserModel::updateOrCreate([
                    'models_id' => $data['models_id'][$key],
                    'user_id' => $request->user_id,
                ],[
                    'user_id' => $request->user_id,
                    'models_id' => $data['models_id'][$key],
                ]);
            }
        }
        return redirect()->route('user.models.index', [$request->program_id,$request->user_id])->with('success', 'Model has been assigned successfully.');
    }

    public function destroy(Request $request) {
        $userModel = UserModel::where(['user_id'=>$request->user_id,'models_id'=>$request->models_id]);
        $userModel->delete();
        return back()->with('success', 'Assign model has been removed successfully.');
    }
}
