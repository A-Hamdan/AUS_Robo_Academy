@extends('backend.layouts.app')
@section('title', $title)
@section('content')
    <x-content-header title='{{ $title }}' icon='lock' link='true'>{{ route('user.model.create', [$category->id, $user->id]) }}</x-content-header>

    <x-main-content>
        <div class="row mt-3">
            <div class="col-12">
                <div class="row">
                    @forelse ($models as $model)
                        <div class="col-3">
                            <div class="card shadow text-center">
                                <div class="card-header">
                                    <h3>{{ substr($model->title,0,13) }}</h3>
                                    <p>{{ substr($model->description,0,20) }}</p>
                                </div>
                                <div class="card-body pt-0 pb-0">
                                    <img class="img-responsive" width="100%" height="200" src="{{ url($model->image) }}" alt=" {{ $model->image }}">
                                </div>
                                <div class="card-footer text-center">
                                    <form action="{{ route('user.model.destroy') }}">
                                        <input type="hidden" name="models_id" value="{{ $model->id }}">
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm btn-block">
                                            <i class="fa fa-trash-alt"></i>
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <x-no-record></x-no-record>
                    @endforelse
                </div>
            </div>
        </div>
    </x-main-content>
@endsection

