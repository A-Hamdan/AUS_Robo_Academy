<img class="img-circle img-responsive mb-2" height="150" width="150" src="{{ Auth::user()->avatar != null ? Auth::user()->avatar : URL::asset('/admin/dist/img/avatar5.png') }}" alt="">
<form action="{{ route('avatar.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <x-form-input for="file" label="{{ __('Change Profile Image') }}" type="file" id="avatar" name="avatar" form="file"></x-form-input>
    <button class="btn btn-info rounded-pill">{{ __('Save Profile Picture') }}</button>
    @if (session()->has('success'))
        {{ session()->get('success') }}
    @endif
</form>
