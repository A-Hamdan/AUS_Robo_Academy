@extends('backend.layouts.app')
@section('title', $title)
@section('content')

    <x-content-header title='{{ $title }}' icon='bars'
        {{-- link='true'>{{ route('student.programs.index',['organisation_id'=> session('organisation_id')] ) }}</x-content-header> --}}
        link='true'>{{  'javascript:history.back()' }}</x-content-header>

    <x-main-content>
        <div class="row">
            @foreach ($categories as $index => $category)
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="m-0">{{ substr(ucwords($category->title), 0,18) }}</h3>
                            <small>{{ substr($category->description, 0, 30) }}</small>
                        </div>
                        <div class="card-footer border-bottom">
                            <div class="row">
                                <div class="col-md-6">Sub Title</div>
                                <div class="col-md-6">
                                    <p class="m-0">{{ substr($category->sub_title, 0, 20) }}</p>
                                </div>
                                <div class="col-md-6">Current Status</div>
                                <div class="col-md-6">
                                    <x-status-button status="{{ $category->is_active }}" routeName="category.status" id="{{ $category->id }}"></x-status-button>
                                </div>
                                <div class="col-md-6">Age Group</div>
                                <div class="col-md-6">
                                    {{ $category->from_age . ' to ' . $category->to_age }}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <img height="300" width="100%" src="{{ env('APP_URL') . $category->image }}" alt="">
                        </div>
                        <div class="card-footer text-center">
                            {{-- <x-action-button id="{{ $category->id }}" show="category.details"
                                edit="category.edit"></x-action-button>
                            <x-confirm-delete id="{{ $category->id }}" delete="category.destroy"></x-confirm-delete> --}}
                            {{-- {{ dd(request()->segment(2)) }} --}}
                            <a href="{{ route('student.videos.index', $category->id)  }}">
                                <button class="btn btn-primary btn-sm p-0 pr-3 pl-3">
                                    <i class="fa fa-video"></i>
                                    Vedio
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-main-content>
@endsection
