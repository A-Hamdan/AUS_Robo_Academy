@extends('backend.layouts.app')
@section('title', $title)
@section('content')
    <x-content-header title='{{ $title }}' icon='lock' link='false'></x-content-header>

    <x-main-content>
        <div class="row mt-4">
            <div class="col-12">
                <form  method="POST" action="{{ route('user.category.store') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="row">
                        @forelse($programs as $program)
                            <div class="col-3">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <h3>{{ substr($program->title,0,14) }}</h3>
                                    </div>
                                    <div class="card-body">
                                        <img class="img-responsive" width="100%" height="220" src="{{ url($program->image) }}" alt="$program->image">
                                    </div>
                                    <div class="card-footer">
                                        <input type="checkbox" value="{{ $program->id }}" name="category_id[]" class="form-control" {{ $user->categories->contains($program) ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <x-no-record></x-no-record>
                        @endforelse
                    </div>
                    @if($programs->count() > 0)
                        <x-form-button></x-form-button>
                    @endif
                </form>
            </div>
        </div>
    </x-main-content>
@endsection
