@extends('backend.layouts.app')
@section('title', $title)
@section('content')
    <x-content-header title='{{ isset($user) ? "Update " . $user->name : "Create " . $title }}' icon='{{ isset($user) ? "edit" : "plus" }}' link='false'></x-content-header>
    <x-main-content>

        <div class="row">
            <div class="col-12">
                <form  method="POST" action="{{ isset($user) ? (request()->segment(1) == 'teacher' ? route('teacher.update', $user->id) : route('user.update', $user->id)) :
                (request()->segment(1) == 'teacher' ? route('teacher.store') :
                (request()->segment(1) == 'parent' ? route('parent.store') : route('user.store')  )  ) }}">
                    @csrf
                    <input type="hidden" name="type" value="{{ request()->type }}">
                    @if(!isset($user))
                        <x-card header="false" footer="false" class="card">
                            <h5>Authentication Fields</h5>
                            {{-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores quis sint corrupti velit.</p> --}}
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <x-form-input for="email" label="Email*" type="email" id="email" placeholder="Enter Email" name="email" form="input" value="{{ old('email') }}"></x-form-input>
                                </div>
                                <div class="col-12 col-md-4">
                                    <x-form-input for="password" label="Password*" type="password" id="password" placeholder="Enter Password" name="password" form="input" value="{{ old('password') }}"></x-form-input>
                                </div>
                                <div class="col-12 col-md-4">
                                    <x-form-input for="password_confirmation" label="Confirm Password*" type="password" id="password_confirmation" placeholder="Confirm Password" name="password_confirmation" form="input" value="{{ old('password_confirmation') }}"></x-form-input>
                                </div>
                            </div>
                        </x-card>
                     @endif
                     @if(request()->routeIs('teacher.edit','teacher.create'))
                        <x-card header="false" footer="false" class="card">
                            <h5>Organisation Information</h5>
                            {{-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores quis sint corrupti velit.</p> --}}
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <x-form-input for="organisation_name" label="Organisation Name*" type="text" id="organisation_name" placeholder="Enter Full Name" name="organisation_name" form="input" value="{{ isset($user) ? $user->organisation_name : old('organisation_name') }}"></x-form-input>
                                </div>
                                <div class="col-12 col-md-6">
                                    <x-form-input for="organisation_id" label="Organisation ID*" type="text" id="organisation_id" placeholder="Enter Full Name" name="organisation_id" form="input" value="{{ isset($user) ? $user->organisation_id : old('organisation_id') }}"></x-form-input>
                                </div>
                            </div>
                        </x-card>
                     @endif
                     <x-card header="false" footer="false" class="card">
                        <h5>Basic Information</h5>
                        {{-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores quis sint corrupti velit.</p> --}}
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <x-form-input for="name" label="Full Name*" type="text" id="name" placeholder="Enter Full Name" name="name" form="input" value="{{ isset($user) ? $user->name : old('name') }}"></x-form-input>
                            </div>
                            <div class="col-12 col-md-4">
                                <x-form-input for="phone_no" label="Phone No" type="text" id="phone_no" placeholder="Enter Phone No" name="phone_no" form="input" value="{{ isset($user) ? $user->phone_no : old('phone_no') }}"></x-form-input>
                            </div>
                            <div class="col-12 col-md-4">
                                <x-form-input for="gender" label="Gender" id="gender" name="gender" form="select">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ isset($user->gender) && $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ isset($user->gender) && $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                                </x-form-input>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-4">
                                <x-form-input for="country" label="Country" id="country" name="country" form="select">
                                    <option value="">Choose Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" @if(isset($user)) {{ $user->country == $country->id ? 'selected' : '' }} @endif> {{ $country->name }}</option>
                                    @endforeach
                                </x-form-input>
                            </div>
                            <div class="col-12 col-md-4">
                                <x-form-input for="state" label="State" id="state" name="state" form="select">
                                    @if(isset($user))
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}" @if(isset($user)) {{ $user->state == $state->id ? 'selected' : '' }} @endif> {{ $state->name }}</option>
                                        @endforeach
                                    @endif
                                </x-form-input>
                            </div>
                            <div class="col-12 col-md-4">
                                {{-- <x-form-input for="city" label="City" id="city" name="city" form="select">
                                    @if(isset($user))
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}" @if(isset($user)) {{ $user->city == $city->division_id ? 'selected' : '' }} @endif> {{ $city->name }}</option>
                                        @endforeach
                                    @endif
                                </x-form-input> --}}
                                <x-form-input for="city" label="City" type="text" id="city" placeholder="Enter City" name="city" form="input" value="{{ isset($user) ? $user->city : old('city') }}"></x-form-input>
                            </div>
                        </div>

                        <x-form-input for="address" label="Address" type="text" id="pac-input" placeholder="Enter Address" name="address" form="input" value="{{ isset($user) ? $user->address : old('address') }}"></x-form-input>
                        <div class="rounded mt-2" id="map" style="height: 200px;"></div>
                        <div id="infowindow-content">
                            <span id="place-name" class="title"></span><br />
                            <span id="place-address"></span>
                        </div>
                    </x-card>
                    @if(request()->routeIs('teacher.edit','teacher.create'))
                        <x-card header="false" footer="false" class="card">
                            <h5>Membership Period</h5>
                            {{-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores quis sint corrupti velit.</p> --}}
                            <x-form-input for="expiration_date" label="Membership Till" type="date" id="expiration_date" placeholder="Enter Expiry Date" name="expiration_date" form="input" value="{{ isset($user) ? $user->expiration_date : old('expiration_date') }}"></x-form-input>
                        </x-card>
                    @endif
                    @if(!isset($user))
                        <x-card header="false" footer="false" class="card d-none">
                            <h5>Assign Role</h5>
                            {{-- <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores quis sint corrupti velit.</p> --}}
                            <x-form-input for="role" label="Role" id="role" name="role" form="select">
                                @foreach ($roles as $index => $role)
                                    @if(request()->segment(1) == 'user' && $index == 1)
                                        <option value="{{ $role->id }}">{{ ucwords(str_replace("-"," ",$role->name)) }}</option>
                                    @elseif(request()->segment(1) == 'teacher' && $index == 2)
                                        <option value="{{ $role->id }}">{{ ucwords(str_replace("-"," ",$role->name)) }}</option>
                                    @elseif(request()->segment(1) == 'parent' && $index == 3)
                                        <option value="{{ $role->id }}">{{ ucwords(str_replace("-"," ",$role->name)) }}</option>
                                    @endif
                                @endforeach
                            </x-form-input>
                        </x-card>
                    @endif
                    <x-form-button></x-form-button>
                </form>
            </div>
        </div>
    </x-main-content>
@endsection
