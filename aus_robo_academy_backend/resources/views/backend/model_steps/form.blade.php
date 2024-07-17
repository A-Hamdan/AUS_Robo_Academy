@extends('backend.layouts.app')
@section('title', $title)
@section('content')
    <x-content-header title='{{ $title }}' icon='{{ isset($modelStep) ? "edit" : "plus" }}' link='false'>{{ route('model.step.store')}}</x-content-header>

    <x-main-content>
        <div class="row">
            @if(isset($modelStep))
                <div class="col-md-3">
                    <x-card header="true" headerTitle="Featured Image" footer="false" class="card">
                        <img class="img-fluid" src="{{ url($modelStep->image) }}" alt="">
                    </x-card>
                </div>
            @endif
            <div class="{{ isset($modelStep) ? 'col-9' : 'col-12' }}">
                <form  method="POST" action="{{ isset($modelStep) ? route('model.step.update', $modelStep->id) : route('model.step.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if(!isset($modelStep))
                        <input type="hidden" name="model_id" value="{{ $model->id }}">
                    @endif
                    <x-card header="false" footer="false" class="card">
                        <x-form-input for="title" label="Title" type="text" id="title" placeholder="Enter Title" name="title" form="input" value="{{ isset($modelStep) ? $modelStep->title : old('title') }}"></x-form-input>
                        <x-form-input for="description" label="Description" id="description" placeholder="Enter Description" name="description" form="textarea">{{ isset($modelStep) ? $modelStep->description : old('description') }}</x-form-input>
                        <x-form-input for="file" label="{{ __('Feature Image (PNG, JPG, JPEG)') }}" type="file" id="image" name="image" form="file"></x-form-input>
                        <x-form-input for="file" label="{{ __('Material File (MTL)') }}" type="file" id="mtl" name="mtl" form="file"></x-form-input>
                        <x-form-input for="file" label="{{ __('3D Object File (OBJ)') }}" type="file" id="obj" name="obj" form="file"></x-form-input>
                    </x-card>
                    <x-form-button></x-form-button>
                </form>
            </div>
        </div>
    </x-main-content>
@endsection
