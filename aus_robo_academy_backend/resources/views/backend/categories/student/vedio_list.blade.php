@extends('backend.layouts.app')
@section('title', $title)
@section('content')
    <x-content-header title='{{ $title }}' icon='video' link='true'>{{ route('student.video.categories.index') }}</x-content-header>

    <x-main-content>
        <div class="row">
            @forelse ($videos as $index => $video)
                <div class="col-4">
                    <div class="card border shadow">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-3">
                                    <img class="img-responsive" height="80" width="100%" src="{{ env('APP_URL') . $video->image }}" alt="">
                                </div>
                                <div class="col-9">
                                    <h3>{{ substr($video->title,0,13) }}</h3>
                                    <p>{{ substr($video->description,0,30) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-bottom">
                            <div class="row">
                                <div class="col-4">Category</div>
                                <div class="col-8">
                                    {{ $video->category->title }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">Status</div>
                                <div class="col-8">
                                    <x-status-button status="{{ $video->is_active }}" routeName="video.status" id="{{ $video->id }}"></x-status-button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- {{ dd(url($video->video)) }} --}}
                            <video class="img-responsive" height="190" width="100%" controls>
                                <source src="{{ url($video->video) }}" type="video/mp4">
                            </video>
                        </div>
                        <div class="card-footer text-center">
                            <x-action-button id="{{ $video->id }}" show="video.details" edit="video.edit"></x-action-button>
                            <x-confirm-delete id="{{ $video->id }}" delete="video.destroy"></x-confirm-delete>
                        </div>
                    </div>
                </div>
            @empty
                <x-no-record></x-no-record>
            @endforelse
        </div>
    </x-main-content>
@endsection
