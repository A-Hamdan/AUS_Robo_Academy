@extends('backend.layouts.app')
@section('title', $title)
@section('content')
    <x-content-header title='{{ $title }}' icon='users' link='true'>{{
        request()->segment(1) == 'teachers' ? route('teacher.create') :
        (request()->segment(1) == 'parents' ? route('parent.create') : route('user.create') )}}
    </x-content-header>

    <x-main-content>
        <div class="row">
            <div class="col-12">
                <x-card header="false" footer="false" class="card">
                    @php
                        $headers = ['S#','Full Name', 'Email', 'Phone No', 'Gender', 'Status', 'Actions'];
                            if (request()->routeIs('teachers.index')) {
                                array_splice($headers, 1, 0, ['Organisation ID']);
                            }
                    @endphp

                    <x-table :headers="$headers">
                        @foreach ($users as $index => $user)
                            <tr>
                                <x-td>{{ $index+1 }}</x-td>
                                @if(request()->routeIs('teachers.index'))
                                    <x-td>{{ $user->organisation_id }}</x-td>
                                @endif
                                <x-td>{{ $user->name }}</x-td>
                                <x-td>{{ $user->email }}</x-td>
                                <x-td>{{ $user->phone_no ?? 'Not available' }}</x-td>
                                <x-td>{{ $user->gender == 'male' ? 'Male' : 'Female'}}</x-td>
                                <x-td><x-status-button status="{{ $user->is_active }}" routeName="user.status" id="{{ $user->id }}"></x-status-button></x-td>
                                <x-td>
                                    @if(request()->routeIs('teachers.index'))
                                        <a href="{{ route('user.categories.index', $user->id) }}">
                                            <button class="btn btn-sm btn-primary p-0 pl-1 pr-1"><i class="fa fa-key"></i> Permissions</button>
                                        </a>
                                    @endif
                                    <x-action-button id="{{ $user->id }}" show="user.details" edit="{{ request()->routeIs('teachers.index') ? 'teacher.edit' : 'user.edit' }}"></x-action-button>
                                    <x-confirm-delete id="{{ $user->id }}" delete="user.destroy"></x-confirm-delete>
                                </x-td>
                            </tr>
                        @endforeach
                    </x-table>
                </x-card>
            </div>
        </div>
    </x-main-content>
@endsection
