@extends('backend.layouts.app')
@section('title', $title)
@section('content')
    <x-content-header title='{{ $title }}' icon='{{ isset($category) ? "edit" : "plus" }}' link='false'>{{ route('category.store')}}</x-content-header>

    <x-main-content>
        <div class="row">
            @if(isset($category))
                <div class="col-md-3">
                    <x-card header="true" headerTitle="Featured Image" footer="false" class="card">
                        <img class="img-fluid" src="{{ url($category->image) }}" alt="">
                    </x-card>
                </div>
            @endif
            <div class="{{ isset($category) ? 'col-9' : 'col-12' }}">
                <form  method="POST" action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if(!isset($category))
                        <input type="hidden" name="type" value="{{ request()->segment(1) == 'programs' ? 'program' : 'video' }}">
                    @endif
                    <x-card header="false" footer="false" class="card">
                        <x-form-input for="title" label="Title" type="text" id="title" placeholder="Enter Program Title" name="title" form="input" value="{{ isset($category) ? $category->title : old('title') }}"></x-form-input>
                        <x-form-input for="sub_title" label="Sub Title" type="text" id="sub_title" placeholder="Enter Program Sub Title" name="sub_title" form="input" value="{{ isset($category) ? $category->sub_title : old('sub_title') }}"></x-form-input>
                        <x-form-input for="description" label="Description" id="description" placeholder="Enter Description" name="description" form="textarea">{{ isset($category) ? $category->description : old('description') }}</x-form-input>
                        <div class="row">
                            <div class="col-md-6">
                                <x-form-input for="from_age" label="From Age" type="text" id="from_age" placeholder="Example 6" name="from_age" form="input" value="{{ isset($category) ? $category->from_age : old('from_age') }}"></x-form-input>
                            </div>
                            <div class="col-md-6">
                                <x-form-input for="to_age" label="To Age" type="text" id="to_age" placeholder="Exmple 12" name="to_age" form="input" value="{{ isset($category) ? $category->to_age : old('to_age') }}"></x-form-input>
                            </div>
                        </div>

                        <x-form-input for="file" label="{{ __('Feature Image') }}" type="file" id="image" name="image" form="file"></x-form-input>
                    </x-card>
                    <x-form-button></x-form-button>
                </form>
            </div>
        </div>
    </x-main-content>
@endsection
