@props(['messages'])

@if ($messages)
    <span {{ $attributes->merge(['class' => 'text-sm text-bold text-danger']) }}>
        @foreach ((array) $messages as $message)
            {{ $message }}
        @endforeach
    </span>
@endif
