<a href="{{ route($routeName,$id) }}">
    @if($status == 1)
        <div class="badge badge-success rounded">Enabled</div>
    @else
        <div class="badge badge-danger rounded">Disabled</div>
    @endif
</a>
