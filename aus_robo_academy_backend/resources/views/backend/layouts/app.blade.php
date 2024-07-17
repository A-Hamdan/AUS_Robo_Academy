<!DOCTYPE html>
<html lang="en">
@include('backend.layouts.header')
@include('backend.layouts.loader')
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
            @include('backend.layouts.nav')
            @include('backend.layouts.aside')
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('backend.layouts.footer')
    </div>
    @include('backend.layouts.script')
</body>
</html>
