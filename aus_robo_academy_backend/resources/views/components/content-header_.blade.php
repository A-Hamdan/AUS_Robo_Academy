<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0"><i class="fa fa-{{ $icon }}"></i> {{ $title }}
                    <a href="{{ $slot }}">
                        @if($link == 'true')
                            <button class="btn btn-sm btn-info rounded-pill shadow">
                                @if(request()->routeIs('user.categories.index'))
                                    <i class="fa fa-plus"></i>
                                    Assign Programs
                                @elseif(request()->routeIs('user.models.index'))
                                    <i class="fa fa-plus"></i>
                                    Assign Models
                                @elseif(request()->routeIs('student.models.index'))
                                    <i class="fa fa-arrow-left"></i>
                                    Back
                                @else
                                    <i class="fa fa-plus"></i>
                                    Create New
                                @endif
                            </button>
                        @endif
                    </a>
                </h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a class="text-info" href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>

