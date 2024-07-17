@extends('backend.layouts.app')
@section('title', $title)
@section('content')
    <x-content-header title='{{ $title }}' icon='bars' link='false'></x-content-header>

    <x-main-content>
        <div class="row">
            @foreach ($categories as $category)
                <div class="col-3">
                    <x-card header="false" footer="false" class="card {{ $category->enabled != true ? 'bg-gradient-light shadow-0' : 'bg-white shadow' }}">
                        <h3 data-toggle="tooltip" data-original-title="{{ $category->title }}">
                            {{ Str::limit($category->title, 10) }}
                        </h3>
                        <hr>
                        <img class="w-100" height="250" src="{{ env('APP_URL') . $category->image  }}" alt="">
                        <form action="{{ route('student.models.index', $category->id) }}" method="get">
                            <input type="hidden" name="organisation_id" value="{{ request()->organisation_id }}">
                            <button type="submit" class="btn {{ $category->enabled == 1 ?'btn-primary' : 'btn-danger' }}  btn-block mt-2" {{ $category->enabled != true ? 'disabled' : '' }}>
                                <i class="fa fa-eye"></i> View Models
                            </button>
                        </form>
                    </x-card>
                </div>
            @endforeach
        </div>
    </x-main-content>

@endsection
