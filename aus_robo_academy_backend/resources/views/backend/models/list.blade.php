@extends('backend.layouts.app')
@section('title', $title)
@section('content')

    @role('teacher')
        <x-content-header title='{{ $title }}' icon='puzzle-piece' link='false'></x-content-header>
    @else
        <x-content-header title='{{ $title }}' icon='puzzle-piece' link='true'>{{ route('model.create') }}</x-content-header>
    @endrole

    <x-main-content>
        {{-- @role(['super-admin','admin'])
            <form action="" method="get">
                <div class="row">
                    <div class="col-9">
                        <x-form-input for="category" label="Select category" id="programs" name="programs" form="select">
                            <option value="all">All Programs</option>
                            @foreach ($programs as $program)
                                <option value="{{ $program->id }}" {{ $program->id == request()->get('programs') ? 'selected' : '' }}>{{ $program->title }}</option>
                            @endforeach
                        </x-form-input>
                    </div>
                    <div class="col-3 mt-1 p-1">
                        <button type="submit" class="btn btn-info btn-block mt-4">Search</button>
                    </div>
                </div>
            </form>
        @endrole --}}

        <div class="row">
            <div class="col-12 mb-3">
                Showing {{ $models->firstItem() }} to {{ $models->lastItem() }} of {{ $models->total() }} records
            </div>
            @forelse ($models as $index => $model)
                <div class="col-md-4">
                    <div class="card card-widget widget-user shadow">
                        <div class="widget-user-header text-dark">
                            <h3 class="widget-user-username mt-3 text-dark">{{ substr($model->title, 0, 20) }}</h3>
                            <p class="widget-user-desc">{{ substr($model->description,0,40) }}</p>
                        </div>
                        <div class="widget-user-image mt-4">
                            <img class="img-responsive border rounded" src="{{ url($model->image) }}" alt="{{ $model->image }}" style="height: 90px;">
                        </div>
                        <div class="card-footer rounded m-3">
                            <div class="row mt-3">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ $model->modelSteps->count() }}</h5>
                                        <span class="">Total Steps</span>
                                    </div>

                                </div>

                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header mt-3">
                                            @role(['super-admin','admin'])
                                                <x-status-button status="{{ $model->is_active }}" routeName="model.status" id="{{ $model->id }}"></x-status-button>
                                            @else
                                                <span class="badge badge-success">Enabled</span>
                                            @endrole
                                        </h5>
                                    </div>

                                </div>

                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header">{{ $model->passcode }}</h5>
                                        <span class="">Passcode</span>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="card-header">
                            <div class="row">
                                <div class="col-4">Program</div>
                                <div class="col-8 text-right">{{ substr($model->category->title,0,20) }}</div>
                            </div>
                            <div class="row">
                                <div class="col-4">Created Date</div>
                                <div class="col-8 text-right">{{ $model->category->created_at->format('M, d Y') }}</div>
                            </div>
                            <div class="row">
                                <div class="col-4">Last Updated</div>
                                <div class="col-8 text-right">{{ $model->category->updated_at->format('M, d Y') }}</div>
                            </div>
                            <div class="row">
                                <div class="col-4">Created By</div>
                                <div class="col-8 text-right">{{ $model->user->name }}</div>
                            </div>
                        </div>
                        <div class="card-body text-center bg-gradient-light rounded">
                            <a href="{{ route('model.steps.index', $model->id) }}">
                                <button class="btn btn-success btn-sm p-0 shadow pl-2 pr-2 rounded">
                                    @role('teacher')
                                        <i class="fa fa-eye"></i>
                                        Start Building
                                        @else
                                        <i class="fa fa-plus"></i>
                                        Steps
                                    @endrole
                                </button>
                            </a>
                            <x-action-button id="{{ $model->id }}" show="model.details" edit="model.edit"></x-action-button>
                            <x-confirm-delete id="{{ $model->id }}" delete="model.destroy"></x-confirm-delete>
                        </div>
                    </div>
                </div>
            @empty
                <x-no-record></x-no-record>
            @endforelse
        </div>
        {{-- Pagination --}}
        <div class="text-center mt-3 col-12" style="text-align: right;justify-content: right;display: flex">
            {!! $models->appends(request()->input())->links('backend.layouts.pagination.pagination') !!}
        </div>
    </x-main-content>
@endsection
