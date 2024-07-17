<div class="form-group">
    <label for="{{ isset($for) ? $for : '' }}">{{ isset($label) ? $label : '' }}</label>
    @if($form == 'input')
        <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" id="{{ $id }}" placeholder="{{ isset($placeholder) ? $placeholder : '' }}" name="{{ $name }}" value="{{ $value }}">
    @elseif($form == 'select')
        <select name="{{ isset($name) ? $name : '' }}" id="{{ isset($id) ? $id : '' }}" class="form-control @error($name) is-invalid @enderror" {{ isset($multiple) ? 'multiple' : '' }}>
            {{ $slot }}
        </select>
    @elseif($form == 'file')
        <div class="custom-file">
            <input type="{{ $type }}" class="custom-file-input @error($name) is-invalid @enderror" id="{{ isset($id) ? $id : '' }}" name="{{ $name }}">
            <label for="exampleInputFile" class="custom-file-label">Choose File</label>
        </div>
    @elseif($form == 'textarea')
        <textarea rows="5" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" id="{{ $id }}" placeholder="{{ isset($placeholder) ? $placeholder : '' }}">{{ $slot }}</textarea>
    @endif

    @error($name)
        <span class="text-danger text-bold text-sm" role="alert">{{ $message }}</span>
    @enderror
</div>
