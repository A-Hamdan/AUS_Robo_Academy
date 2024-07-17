@extends('backend.layouts.app')
@section('title', $title)
@section('content')
    <x-content-header title='{{ $title }}' icon='{{ isset($model) ? "edit" : "plus" }}' link='false'>{{ route('model.store')}}</x-content-header>

    <x-main-content>
        <div class="row">
            @if(isset($model))
                <div class="col-md-3">
                    <x-card header="true" headerTitle="Featured Image" footer="false" class="card">
                        <img class="img-fluid" src="{{ url($model->image) }}" alt="">
                    </x-card>
                </div>
            @endif
            <div class="{{ isset($model) ? 'col-9' : 'col-12' }}">
                <form  method="POST" action="{{ isset($model) ? route('model.update', $model->id) : route('model.store') }}" enctype="multipart/form-data">
                    @csrf
                    <x-card header="false" footer="false" class="card">
                        <x-form-input for="title" label="Title" type="text" id="title" placeholder="Enter Model Title" name="title" form="input" value="{{ isset($model) ? $model->title : old('title') }}"></x-form-input>
                        <x-form-input for="description" label="Description" id="description" placeholder="Enter Description" name="description" form="textarea">{{ isset($model) ? $model->description : old('description') }}</x-form-input>
                        <x-form-input for="category" label="Select Program" id="category" name="category" form="select">
                            @forelse (auth()->user()->hasRole('teacher') ? auth()->user()->categories : $programs as $program)
                                <option value="{{ $program->id }}" @if(isset($model)) {{ $model->category_id == $program->id ? 'selected' :''  }} @endif>{{ $program->title }}</option>
                            @empty
                                <option value="">No Program Found.</option>
                            @endforelse
                        </x-form-input>
                        <x-form-input for="passcode" label="Pass Code" type="text" id="passcode" placeholder="Enter Pass Code" name="passcode" form="input" value="{{ isset($model) ? $model->passcode : old('passcode') }}"></x-form-input>
                        <x-form-input for="file" label="{{ __('Feature Image') }}" type="file" id="image" name="image" form="file"></x-form-input>
                    </x-card>
                    <x-form-button></x-form-button>
                </form>
            </div>
        </div>
    </x-main-content>
@endsection
