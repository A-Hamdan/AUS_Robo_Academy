@extends('backend.layouts.app')
@section('title', $title)
@section('content')
    <x-content-header title='{{ $title }}' icon='list-ol' link='{{ auth()->user()->hasRole(["super-admin","admin"]) ? "true" : "false" }}'>
        {{ route('model.step.create', $model->id)}}
    </x-content-header>

    <x-main-content>
        @if($modelSteps->count() > 0)
            <p style="margin-top: -15px;">This is your model steps and if you want to move the step just hold the step and drag to your desire position.</p>
        @endif

        {{-- <div class="row">
            <div class="col-12">
                Showing {{ $modelSteps->firstItem() }} to {{ $modelSteps->lastItem() }} of {{ $modelSteps->total() }} records
            </div>
        </div> --}}

        <div class="row mt-4" id="sortable-list">
            @forelse ($modelSteps as $index => $modelStep)
                <div class="col-4" data-id="{{ $modelStep->id }}">
                    <div class="card shadow" style="cursor: -webkit-grab; cursor: grab;">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <i class="fas fa-feather text-secondary"></i>
                                    STEP {{ $index+1 }}
                                </div>
                                <div class="col-6 text-right">
                                    @if(auth()->user()->hasRole("super-admin"))
                                        @if($modelStep->mtl == null || $modelStep->obj == null)
                                            <div class="badge badge-danger">Disabled</div>
                                        @else
                                            <x-status-button status="{{ $modelStep->is_active }}" routeName="model.step.status" id="{{ $modelStep->id }}"></x-status-button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <h3>{{ substr($modelStep->title,0,25) }}</h3>
                            <p>{{ substr($modelStep->description,0,40) }}</p>
                            <img class="img-responsive" height="300" width="100%" src="{{ url($modelStep->image) }}" alt="">
                        </div>
                        <div class="card-footer p-3 text-center">
                            <x-action-button id="{{ $modelStep->id }}" show="model.step.details" edit="model.step.edit"></x-action-button>
                            <x-confirm-delete id="{{ $modelStep->id }}" delete="model.step.destroy"></x-confirm-delete>
                        </div>
                    </div>
                </div>
            @empty
                <x-no-record></x-no-record>
            @endforelse
        </div>

        {{-- <div class="text-center mt-3 col-12" style="text-align: right;justify-content: right;display: flex">
            {!! $modelSteps->appends(request()->input())->links('backend.layouts.pagination.pagination') !!}
        </div> --}}

    </x-main-content>
@endsection
