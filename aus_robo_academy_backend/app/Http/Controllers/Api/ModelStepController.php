<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models;
use App\Models\ModelStep;
use App\Http\Resources\ModelStepResource;

class ModelStepController extends Controller
{
    public function index(Models $model) {
        $modelSteps = ModelStep::where(['model_id' => $model->id])->orderBy('position','asc')->get();
        return ModelStepResource::collection($modelSteps);
    }
}
