<aside class="main-sidebar sidebar-light-info" style="background-image: linear-gradient(#F8E177, #54B593);">
    <!-- Brand Logo -->
    <a
        href="{{ auth()->check() ? route('dashboard') : route('student.programs.index', ['organisation_id' => session('organisation_id')]) }}" class="brand-link" style="margin-bottom: 150px;">
        <img src="{{ URL::asset('/admin/dist/img/logo.png') }}" height="150" alt="AU Robo Academy Logo"
            class="brand-logo logo-xl" style="margin-left: 50px">
        <img src="{{ URL::asset('/admin/dist/img/logo.png') }}" height="60" alt="AU Robo Academy Logo"
            class="brand-logo logo-xs">
    </a>

    @if (Auth::check())
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image mt-2">
                    <img src="{{ Auth::user()->avatar != null ? url(Auth::user()->avatar) : (Auth::user()->gender == 'male' ? URL::asset('/admin/dist/img/avatar5.png') : URL::asset('/admin/dist/img/avatar2.png')) }}"
                        class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="{{ route('profile.edit') }}" class="d-block">Hi, {{ Auth::user()->name }}</a>
                    <span>Login as: {{ ucwords(str_replace('-', ' ', Auth::user()->roles->pluck('name')[0])) }}</span>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}"
                            class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-home"></i>
                            <p>{{ __('Dashboard') }}</p>
                        </a>
                    </li>
                    @role(['super-admin', 'admin'])
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}"
                                class="nav-link {{ request()->segment(1) == 'users' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>{{ __('Users') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('teachers.index') }}"
                                class="nav-link {{ request()->segment(1) == 'teachers' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>{{ __('Teachers') }}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('parents.index') }}"
                                class="nav-link {{ request()->segment(1) == 'parents' ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-lock"></i>
                                <p>{{ __('Parents') }}</p>
                            </a>
                        </li>
                    @endrole
                    {{-- <li class="nav-item">
                    <a href="{{ route('models.index') }}" class="nav-link {{ request()->routeIs('models.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-puzzle-piece"></i>
                        <p>{{ __('Models') }}</p>
                    </a>
                </li> --}}
                @role(['super-admin','admin','teacher'])
                    <li class="nav-item">
                        <a href="{{ route('programs.index') }}"
                            class="nav-link {{ request()->segment(1) == 'programs' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-puzzle-piece"></i>
                            <p>{{ __('Models') }}</p>
                        </a>
                    </li>
                @endrole
                    {{-- <li class="nav-item">
                    <a href="{{ route('videos.index') }}"
                        class="nav-link {{ request()->routeIs('videos.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-video"></i>
                        <p>{{ __('Videos') }}</p>
                    </a>
                </li> --}}
                    {{-- @role(['super-admin', 'admin']) --}}
                    <li class="nav-item">
                        <a href="{{ route('video.categories.index') }}"
                            class="nav-link {{ request()->segment(1) . '/' . request()->segment(2) == 'video/categories' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-video"></i>
                            <p>{{ __('Learning Zone') }}</p>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                    <a href="{{ route('permissions.index') }}"
                        class="nav-link ">
                        <i class="nav-icon fas fa-lock"></i>
                        <p>{{ __('Permissions') }}</p>
                    </a>
                </li> --}}
                    {{-- @endrole --}}
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="nav-link text-dark"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>{{ __('Logout') }}</p>
                            </a>
                        </form>
                    </li>
                </ul>
    @endif


    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        @if (request()->segment(1) == 'student')
            {{-- kamran ali  --}}
        <li class="nav-item">

            <a href="{{ route('student.programs.index', ['organisation_id' => session('organisation_id')]) }}" class="nav-link text-dark"
            > <i class="nav-icon fas fa-home"></i>
                <p>{{ __('Dashboard') }}</p>
                </a>
        </li>
        <li class="nav-item">

            <a href="{{ route('student.video.categories.index') }}" class="nav-link text-dark"
            > <i class="nav-icon fas fa-video"></i>
                <p>{{ __('Learning Zone') }}</p>
                </a>
        </li>

        <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="nav-link text-dark"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>{{ __('Logout') }}</p>
                    </a>
                </form>
            </li>
        @endif
    </ul>


    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
