@extends('backend.layouts.app')
@section('title', $title)
@section('content')
    <x-content-header title='{{ $title }}' icon='lock' link='true'>{{ route('user.category.create', $user->id) }}</x-content-header>

    <x-main-content>
        <div class="row mt-4">
            <div class="col-12">
                <div class="row">
                    @forelse ($programs as $program)
                        <div class="col-3">
                            <div class="card shadow text-center">
                                <div class="card-header">
                                    <h3>{{ substr($program->title,0,13) }}</h3>
                                    <p class="m-0">{{ substr($program->description,0,20) }}</p>
                                </div>
                                <div class="card-body pt-0 pb-0">
                                    <img class="img-responsive" width="100%" height="200" src="{{ url($program->image) }}" alt="$program->image">
                                </div>
                                <div class="card-footer d-flex">
                                    {{-- <a href="{{ route('user.models.index', $program->id) }}"> --}}
                                    <a href="{{ route('user.models.index', [$program->id,$user->id]) }}">

                                        <button type="submit" class="btn btn-sm btn-info ml-4">
                                            <i class="fas fa-puzzle-piece"></i>
                                            Models
                                        </button>
                                    </a>
                                    <form action="{{ route('user.category.destroy') }}">
                                        <input type="hidden" name="category_id" value="{{ $program->id }}">
                                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-sm btn-danger ml-2">
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

