<div class="{{ isset($class) ? $class : '' }}" id="{{ isset($id) ? $id : null }}">
    @if($header == 'true')
        <div class="card-header">
            {{ $headerTitle }}
        </div>
    @endif
    <div class="card-body">
        {{ $slot}}
    </div>
    @if($footer == 'true')
        <div class="card-footer">
            {{ $footerTitle }}
        </div>
    @endif
</div>
