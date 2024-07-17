<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right @if(session()->has('locale')) {{ session()->get('locale') == 'en' ? 'float-right' : 'float-left' }} @endif d-none d-sm-inline">
        {{ __('Design & Developed By') }} <a href="https://www.logoinn.com" target="_blank">
            <img src="{{ URL::asset('/admin/dist/img/logo_inn.png') }}" height="20" alt="IT Sec Logo" class="img-responsive">
        </a>
    </div>

    <!-- Default to the left -->
    <strong>{{ __('Copyright') }} &copy; 2022-2023 <a class="text-info" href="https://auroboacademy.com" target="_blank">{{ __('Australian Robo Academy') }}</a></strong> {{ __('All Rights Reserved')}}
</footer>
