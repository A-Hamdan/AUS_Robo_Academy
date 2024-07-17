<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-8">
                <h1 class="m-0"><i class="fa fa-{{ $icon }}"></i> {{ $title }}
                    @if (isset($back))
                        <a href="{{ $back }}" class="btn btn-info  ">
                            <i class="fas fa-reply"></i> Back
                        </a>
                    @endif
                    <a href="{{ $slot }}">
                        @if ($link == 'true')
                            <button class="btn btn-sm btn-info rounded-pill shadow">
                                @if (request()->routeIs('user.categories.index'))
                                    Assign Programs
                                    <i class="fa fa-plus"></i>
                                @elseif(request()->routeIs('user.models.index'))
                                    Assign Models
                                    <i class="fa fa-plus"></i>
                                @elseif(request()->routeIs('student.video.categories.index'))
                                    <i class="fas fa-reply-all"></i>
                                    Back
                                @elseif(request()->routeIs('student.videos.index'))
                                    <i class="fas fa-reply-all"></i>
                                    Back
                                @else
                                    @role(['super-admin', 'admin'])
                                        <i class="fa fa-plus"></i>
                                        Create New
                                    @else
                                        <i class="fas fa-reply-all "></i>
                                        Back
                                    @endrole
                                @endif
                            </button>
                        @endif
                    </a>
                </h1>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a class="text-info"
                            href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item active">{{ $title }}</li>
                </ol>
            </div>
        </div>
    </div>
</div>
