@extends('backend.layouts.app')
@section('title', $title)
@section('content')
    <x-content-header title='{{ $title }}' icon='lock' link='false'></x-content-header>

    <x-main-content>
        <div class="row">
            <div class="col-12">
                @if($models->count() > 0)
                    <p>Showing {{ $models->count() }} Models</p>
                @endif
                <form  method="POST" action="{{ route('user.model.store') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <input type="hidden" name="program_id" value="{{ $category->id }}">
                    <div class="row">
                        @forelse($models as $model)
                            <div class="col-3">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <h3>{{ substr($model->title,0,14) }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <img class="img-responsive" width="100%" height="220" src="{{ url($model->image) }}" alt="{{ $model->image }}">
                                    </div>
                                    <div class="card-footer">
                                        <input type="checkbox" value="{{ $model->id }}" name="models_id[]" class="form-control" {{ $user->models->contains($model) ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <x-no-record></x-no-record>
                        @endforelse
                    </div>
                    @if($models->count() > 0)
                        <x-form-button></x-form-button>
                    @endif
                </form>
            </div>
        </div>
    </x-main-content>
@endsection
