@extends('backend.layouts.app')
@section('content')
@section('title', $title)
    <x-content-header title='{{ $title }}' icon='cog' link='false'></x-content-header>

    <x-main-content>
        <div class="row">
            <div class="col-12">
                <x-card header="false" footer="false" class="card">
                    @include('profile.partials.update-avatar')
                </x-card>
            </div>
            @role('firm')
                <div class="col-12">
                    <x-card header="false" footer="false" class="card">
                        @include('profile.partials.update-logo')
                    </x-card>
                </div>
            @endrole
            <div class="col-12">
                <x-card header="false" footer="false" class="card">
                    @include('profile.partials.update-profile-information-form')
                </x-card>
            </div>
            <div class="col-12">
                <x-card header="false" footer="false" class="card">
                    @include('profile.partials.update-password-form')
                </x-card>
            </div>
            {{-- <div class="col-12">
                <x-card header="false" footer="false" class="card">
                    @include('profile.partials.delete-user-form')
                </x-card>
            </div> --}}
        </div>
    </x-main-content>
@endsection
