<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models;
use App\Models\ModelStep;
use App\Models\Category;
use App\Http\Requests\StoreModelStepRequest;
use App\Http\Requests\UpdateModelStepRequest;
use Validator;

class ModelStepController extends Controller
{
    public function index(Models $model) {
        $title = $model->title . ' Steps';
        if (auth()->user()->hasRole(['super-admin','admin'])) {
            $modelSteps = ModelStep::where('model_id',$model->id)->orderBy('position')->get();
            return view('backend.model_steps.list', compact('title','modelSteps','model'));
        } else{
            $modelSteps = ModelStep::where('model_id',$model->id)->orderBy('position')->get();
            return view('backend.model_steps.student.list', compact('title','modelSteps','model'));
        }
    }

    public function show(ModelStep $modelStep) {
        return $modelStep;
    }

    public function create(Models $model) {
        $title = 'Create Step For ' . $model->title;
        return view('backend.model_steps.form', compact('title','model'));
    }

    public function store(StoreModelStepRequest $request) {
        $image = $request->file('image')->store('admin/model_steps/feature_image', 'public');

        if($request->has('mtl')) {
            $mtl = $request->file('mtl')->store('admin/model_steps/mtl_file', 'public');
        }

        if($request->has('obj')) {
            $obj = $request->file('obj')->store('admin/model_steps/3d_obj_file', 'public');
        }

        if($request->has('mtl') && $request->has('obj')) {
            $status = true;
        } else {
            $status = false;
        }

        $modelStep = ModelStep::create([
            'model_id' => $request->model_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => 'storage/'.$image,
            $request->has('mtl') ? 'mtl' : '' => $request->has('mtl') ? 'storage/'.$mtl : '',
            $request->has('obj') ? 'obj' : '' => $request->has('obj') ? 'storage/'.$obj : '',
            'is_active' => $status,
        ]);
        return redirect()->route('model.steps.index', $request->model_id)->with('success', $request->title .' has been added successfully.');
    }

    public function edit(ModelStep $modelStep) {
        $title = 'Update ' . $modelStep->title;
        return view('backend.model_steps.form', compact('title','modelStep'));
    }

    public function update(UpdateModelStepRequest $request, ModelStep $modelStep) {

        if($request->has('image')) {
            $image = $request->file('image')->store('admin/model_steps/feature_image', 'public');
        }

        if($request->has('mtl')) {
            $mtl = $request->file('mtl')->store('admin/model_steps/mtl_file', 'public');
        }

        if($request->has('obj')) {
            $obj = $request->file('obj')->store('admin/model_steps/3d_obj_file', 'public');
        }

        $modelStep->update([
            'title' => $request->title,
            'description' => $request->description,
            $request->has('image') ? 'image' : '' => $request->has('image') ? 'storage/'.$image : '',
            $request->has('mtl') ? 'mtl' : '' => $request->has('mtl') ? 'storage/'.$mtl : '',
            $request->has('obj') ? 'obj' : '' => $request->has('obj') ? 'storage/'.$obj : ''
        ]);
        return redirect()->route('model.steps.index', $modelStep->model_id)->with('success', $request->title .' has been updated successfully.');
    }

    public function status(ModelStep $modelStep) {
        $status = $modelStep->is_active == 1 ? 0 : 1;
        $modelStep->update(['is_active' => $status]);
        return back()->with('success', $status == 1 ? $modelStep->title.' status has been changed to Enabled.' : $modelStep->title. ' status has been changed to Disabled.');
    }

    public function destroy(ModelStep $modelStep) {
        $modelStep->delete();
        return back()->with('success', $modelStep->title . ' has been deleted successfully.');
    }

    public function updateOrder(Request $request) {

        foreach ($request->input('order') as $order => $itemId) {
            $item = ModelStep::findOrFail($itemId);
            $item->update([
                'position' => $order,
            ]);
        }
        return response()->json(['success' => true, 'message' => 'Sorting updated successfully!']);
    }

    public function index2(Request $request) {

        $model = Models::where('id', $request->model_id)->first();

        $validator = Validator::make($request->all(), [
            'passcode' => 'required',
        ]);

        if($validator->fails())
            return back()->with('error', 'Please enter passcode to proceed.');

        if ($model->passcode != $request->passcode)
            return back()->with('error', 'The passcode you entered is invalid.');

        $modelSteps = ModelStep::where('model_id',$request->model_id)
        ->orderBy('position')
        ->get();

        if(!$modelSteps->count() >= 1 ) {
            return back()->with('error', 'No steps found in this moment.');
        }

        $title = $model->title . ' Steps';
        return view('backend.model_steps.student.list', compact('title','modelSteps','model'));
    }

}
