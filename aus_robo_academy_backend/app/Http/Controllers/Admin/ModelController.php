<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models;
use App\Models\Category;
use App\Models\User;
use App\Models\UserModel;
use App\Http\Requests\StoreModelRequest;
use App\Http\Requests\UpdateModelRequest;
use Validator;

class ModelController extends Controller
{
    // public function index(Request $request) {
    //     if(auth()->user()->hasRole(['super-admin','admin'])) {

    //         $categoryId = $request->programs;

    //         if($categoryId === 'all') {
    //             $models = Models::with('category','modelSteps')->get();
    //         }else {
    //             $models = Models::when($categoryId, function ($query) use ($categoryId) {
    //                 $query->where('category_id', $categoryId);
    //             })->get();
    //         }

    //     }else {
    //         // $models = Models::with('category','modelSteps')->where('user_id', auth()->user()->id)->get();
    //         $models = User::with('models')->where('id', auth()->user()->id)->first()->models;
    //     }

    //     $title = 'Models';
    //     return view('backend.models.list', compact('title','models'));
    // }

    public function index(category $category) {
        if(auth()->user()->hasRole(['super-admin','admin'])) {
            $models = Models::with('category','modelSteps')->where('category_id',$category->id)->paginate(12);
        }else {
            $modelId = UserModel::where('user_id', auth()->user()->id)->pluck('models_id')->toArray();
            $models = Models::with('category','modelSteps')
            ->whereIn('id',$modelId)
            ->where(['category_id'=>$category->id,'is_active'=>true])
            ->paginate(12);
        }

        $title = 'Models';
        return view('backend.models.list', compact('title','models'));
    }

    public function show(Models $model) {
        return $model;
    }

    public function create() {
        $title = 'Create Model';
        return view('backend.models.form', compact('title'));
    }

    public function store(StoreModelRequest $request) {
        $image = $request->file('image')->store('admin/models', 'public');

        $category = Models::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category,
            'passcode' => $request->passcode,
            'image' => 'storage/'.$image
        ]);
        return redirect()->route('models.index',$category->category_id)->with('success', $request->title .' has been added successfully.');
    }

    public function edit(Models $model) {
        $title = 'Update ' . $model->title;
        return view('backend.models.form', compact('title','model'));
    }

    public function update(UpdateModelRequest $request, Models $model) {
        if($request->has('image')) {
            $image = $request->file('image')->store('admin/models', 'public');
        }

        $model->update([
            'title' => $request->title,
            'description' => $request->description,
            'passcode' => $request->passcode,
            'category_id' => $request->category,
            $request->has('image') ? 'image' : '' => $request->has('image') ? 'storage/'.$image : '',
        ]);
        return redirect()->route('models.index',$model->category_id)->with('success', $request->title .' has been updated successfully.');
    }

    public function status(Models $model) {
        $status = $model->is_active == 1 ? 0 : 1;
        $model->update(['is_active' => $status]);
        return back()->with('success', $status == 1 ? $model->title.' has been changed to Enabled.' : $model->title. ' has been changed to Disabled.');
    }

    public function destroy(Models $model) {
        if($model->modelSteps()->count() > 0) {
            return redirect()->route('models.index',$model->category_id)->with('error', 'Cannot delete the record because it has related records.');
        }else {
            $model->delete();
            return back()->with('success', $model->title . ' has been deleted successfully.');
        }
    }

    public function getModelsByProgramAndOrganisationId(Request $request,Category $category) {
        $validator = Validator::make($request->all(), [
            'organisation_id' => 'required|string',
        ]);

        if($validator->fails())
            return back()->with('error', 'Please enter your Organisation ID to proceed.');

        $user = User::where('organisation_id', $request->organisation_id)->first();

        if (!$user)
            return back()->with('error', 'The Organisation ID you entered is invalid.');

        $models = Models::where([
            'category_id' => $category->id,
            'is_active' => true,
        ])
        ->get();

        $userModels = UserModel::where('user_id', $user->id)->pluck('models_id')->toArray();

        $model = $models->map(function ($models) use ($userModels) {
            $models->enabled = in_array($models->id, $userModels);
            return $models;
        });

        $title = "Models";
        return view('backend.models.student.list', compact('title','models'));
    }

}
