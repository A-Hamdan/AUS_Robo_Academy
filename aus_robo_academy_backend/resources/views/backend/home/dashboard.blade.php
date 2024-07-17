@extends('backend.layouts.app')
@section('title', $title)
@section('content')
    <x-main-content>
        <div class="row pt-3">
            <div class="@role('teacher') col-lg-6 @endrole col-lg-3 col-6">
                <div class="rounded small-box bg-gradient-olive">
                    <div class="inner">
                        <h3>{{ $totalVideos }}</h3>
                        <p>{{ __('Total Videos') }}</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            @role(['super-admin','admin'])
                <div class="col-lg-3 col-6">
                    <div class="rounded small-box bg-gradient-info">
                        <div class="inner">
                            <h3>{{ $totalUsers }}</h3>
                            <p>{{ __('Total Users') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-tie"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="rounded small-box bg-gradient-danger">
                        <div class="inner">
                            <h3>{{ $totalTeachers }}</h3>
                            <p>{{ __('Total Teachers') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-building"></i>
                        </div>
                    </div>
                </div>
            @endrole
            @role(['super-admin','admin','teacher'])
                <div class="@role('teacher') col-lg-6 @endrole col-lg-3 col-6">
                    <div class="rounded small-box bg-gradient-secondary">
                        <div class="inner">
                            <h3>{{ $totalPrograms }}</h3>
                            <p>{{ __('Total Programs') }}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                    </div>
                </div>
            @endrole
        </div>
    </x-main-content>
@endsection
