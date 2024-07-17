<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ModelResource;
use App\Http\Requests\Api\GetModelRequest;
use App\Models\User;
use App\Models\Models;
use App\Models\Category;
use App\Models\UserModel;


class ModelController extends Controller
{
    public function index(Category $category, GetModelRequest $request) {

        $user = User::where('organisation_id', $request->organisation_id)->first();

        if (!$user)
            return response()->json(['message' => 'Invalid organization ID'], 400);

        $models = Models::where([
            'category_id' => $category->id,
            'is_active' => true,
        ])
        ->get();

        $userModels = UserModel::where('user_id', $user->id)->pluck('models_id')->toArray();

        $models = $models->map(function ($model) use ($userModels) {
            $model->enabled = in_array($model->id, $userModels);
            return $model;
        });

        return ModelResource::collection($models);
    }

    public function getUserModels(Category $category) {
        $userModels = Models::whereHas('userModels', function($q) {
            $q->where('user_id', auth()->user()->id);
        })
        ->where('category_id', $category->id)
        ->get();

        return ModelResource::collection($userModels);

    }

    public function getModelsByCategory(Category $category) {
        $models = Models::where([
            'category_id' => $category->id,
            'is_active' => true,
        ])
        ->get();
        return ModelResource::collection($models);
    }

    public function getMultipleModels(Request $request) {
        $ids = $request->input('ids', []);

        $validatedIds = collect($ids)->filter(function ($id) {
            return is_numeric($id);
        })->toArray();

        $models = Models::whereIn('id', $validatedIds)->get();
        return ModelResource::collection($models);

    }

}
