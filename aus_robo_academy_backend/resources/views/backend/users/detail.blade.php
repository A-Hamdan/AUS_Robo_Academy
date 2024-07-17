@extends('backend.layouts.app')
@section('title', $title)
@section('content')
    <x-content-header title='{{ $title }}' icon='users' link='false'></x-content-header>

    <x-main-content>
          <div class="row">
            <div class="col-md-4">
              <div class="card text-center">
                <div class="card-body box-profile">
                  <img class="profile-user-img img-fluid img-circle" src="{{ $user->avatar ? env('APP_URL') . $user->avatar : URL::asset('/admin/dist/img/avatar5.png') }}" alt="User profile picture">
                  <h3 class="profile-username text-center">{{ $user->name }}</h3>
                  <p class="text-muted text-center">{{ $user->email }}</p>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <h3>User Information</h3>
                </div>
                <div class="card-body">
                  <strong><i class="fas fa-phone mr-1"></i> Phone</strong>
                  <p class="text-muted">{{ $user->phone_no }}</p>

                  <strong><i class="fas fa-venus-mars mr-1"></i> Gender</strong>
                  <p class="text-muted">{{ $user->gender }}</p>

                  <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>
                  <p class="text-muted">{{ $user->address }}</p>
                </div>
              </div>
            </div>
          </div>
    </x-main-content>
@endsection
