@extends('backend.layouts.app')
@section('title', $title)
@section('content')
    <x-content-header title='{{ $title }}' icon='bars' link='true'>{{ route('student.programs.index',['organisation_id'=>request()->organisation_id]) }}</x-content-header>

    <x-main-content>
        <div class="row">
            @foreach ($models as $model)
                <div class="col-3">
                    <x-card header="false" footer="false" class="card {{ $model->enabled != true ? 'bg-gradient-light shadow-0' : 'bg-white shadow' }}">
                        <h3 data-toggle="tooltip" data-original-title="{{ $model->title }}">
                            {{ Str::limit($model->title, 10) }}
                        </h3>
                        <hr>
                        <img class="w-100" height="250" src="{{ env('APP_URL') . $model->image  }}" alt="">
                        <button
                            class="passcode btn {{ $model->enabled == 1 ?'btn-primary' : 'btn-danger' }}  btn-block mt-2"
                            data-toggle="modal"
                            data-target="#passcode"
                            {{ $model->enabled != true ? 'disabled' : '' }}
                            data-model-id="{{ $model->id }}"
                        >
                            <i class="fa fa-puzzle-piece"></i> Start Building
                        </button>
                    </x-card>
                </div>
                @endforeach
            </div>
        </x-main-content>
        @include('backend.layouts.modals.passcode')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.passcode').click(function () {
                var modelId = $(this).data('model-id');
                $('#modelId').text(modelId);
                $('#model_id').val(modelId);
            });
        });
    </script>
@endsection
