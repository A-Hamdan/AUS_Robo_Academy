<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserCategory;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Hash;
use DB;

class UserController extends Controller
{
    public function index() {

        $users = User::whereHas("roles", function($roles){
            if(request()->segment(1) == 'users') {
                $roles->whereIn('name', ['super-admin','admin']);
            }elseif(request()->segment(1) == 'teachers') {
                $roles->where('name','teacher');
            }elseif(request()->segment(1) == 'parents') {
                $roles->where('name','parent');
            }
        })
        ->where('id', '!=', auth()->user()->id)
        ->get();

        $title = request()->segment(1) == 'users' ? 'Users' : (request()->segment(1) == 'teachers' ? 'Teachers' : 'Parents');
        return view('backend.users.list', compact('title','users'));
    }

    public function show(User $user) {
        $title = 'User Details';
        return view('backend.users.detail', compact('title','user'));
    }

    public function create() {
        $title = request()->segment(1). '/' .  request()->segment(2) == 'user/create' ? 'User' : 'Teacher';
        return view('backend.users.form', compact('title'));
    }

    public function store(StoreUserRequest $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_no' => $request->phone_no,
            'gender' => $request->gender,
            'address' => $request->address,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'expiration_date' => $request->expiration_date,
            'organisation_name' => $request->organisation_name,
            'organisation_id' => $request->organisation_id,
        ]);

        $user->assignRole($request->role);
        return redirect()->route($request->role == 3 ? 'teachers.index' : ($request->role == 4 ? 'parents.index' :'users.index'))->with('success', $request->name . ' has been added successfully.');
    }

    public function edit(User $user) {
        $title = 'Update User';
        return view('backend.users.form', compact('title','user'));
    }

    public function update(UpdateUserRequest $request, User $user) {

        $update = $user->update([
            'name' => $request->name,
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'gender' => $request->gender,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'expiration_date' => $request->expiration_date,
            'organisation_name' => $request->organisation_name,
            'organisation_id' => $request->organisation_id,
        ]);

        if($update)
            return redirect()->route($request->routeIs('teacher.update') ? 'teachers.index' : ($request->routeIs('parent.update') ? 'parents.index' :'users.index'))->with('success','Data has been updated successfully.');
            return back()->with('Error','Something Wrong.');
    }

    public function status(User $user) {
        $status = $user->is_active == 1 ? 0 : 1;
        $user->update(['is_active' => $status]);
        return back()->with('success', $status == 1 ? $user->name.' status has been changed to Enabled.' : $user->name. ' status has been changed to Disabled.');
    }

    public function destroy(User $user) {
        $user->delete();
        return back()->with('success', $user->name . ' has been deleted successfully.');
    }

    public function getStateByCountry($id) {
        $state = DB::table('world_divisions')->where('country_id',$id)->get();
        return response()->json($state);
    }

    public function getCityByState($id) {
        $city = DB::table('world_cities')->where('division_id',$id)->get();
        return response()->json($city);
    }
}
