@extends('backend.layouts.app')
@section('title', $title)
@section('content')
    <x-content-header title='{{ $title }}' icon='{{ isset($video) ? "edit" : "plus" }}' link='false'>{{ route('video.store')}}</x-content-header>

    <x-main-content>
        <div class="row">
            @if(isset($video))
                <div class="col-md-3">
                    <x-card header="true" headerTitle="Featured Image" footer="false" class="card">
                        <img class="img-responsive" height="290" width="250" src="{{ url($video->image) }}" alt="">
                    </x-card>
                    <x-card header="true" headerTitle="Uploaded Video" footer="false" class="card">
                        <video class="img-responsive" width="100%" controls>
                            <source src="{{ url($video->video) }}" type="video/mp4">
                        </video>
                    </x-card>
                </div>
            @endif
            <div class="{{ isset($video) ? 'col-9' : 'col-12' }}">
                <form  method="POST" action="{{ isset($video) ? route('video.update', $video->id) : route('video.store') }}" enctype="multipart/form-data">
                    @csrf
                    <x-card header="false" footer="false" class="card">
                        <x-form-input for="title" label="Title" type="text" id="title" placeholder="Enter Video Title" name="title" form="input" value="{{ isset($video) ? $video->title : old('title') }}"></x-form-input>
                        <x-form-input for="description" label="Description" id="description" placeholder="Enter Description" name="description" form="textarea">{{ isset($video) ? $video->description : old('description') }}</x-form-input>
                        <x-form-input for="category" label="Choose Video Category" id="category" name="category" form="select">
                            @forelse ($categories as $category)
                                <option value="{{ $category->id }}" {{ isset($video->category_id) == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                            @empty
                                <option value="">No Category Found.</option>
                            @endforelse
                        </x-form-input>
                        <x-form-input for="file" label="{{ __('Feature Image') }}" type="file" id="image" name="image" form="file"></x-form-input>
                        <x-form-input for="file" label="{{ __('Select Video File') }}" type="file" id="video" name="video" form="file"></x-form-input>
                    </x-card>
                    <x-form-button></x-form-button>
                </form>
            </div>
        </div>
    </x-main-content>
@endsection
