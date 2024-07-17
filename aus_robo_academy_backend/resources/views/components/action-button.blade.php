@role(['super-admin','admin'])
    @if(!request()->routeIs(['programs.index','models.index','model.steps.index','videos.index','video.categories.index']))
        <a href="{{ route($show,$id) }}">
            <button type="button" class="btn btn-info btn-sm shadow p-0 pr-2 pl-2 rounded">
                <i class="fa fa-info-circle"></i> Details
            </button>
        </a>
    @endif
    <a href="{{ route($edit,$id) }}">
        <button type="button" class="btn btn-warning btn-sm shadow p-0 pr-2 pl-2 rounded">
            <i class="fa fa-edit"></i> Edit
        </button>
    </a>

    <button type="button" class="btn btn-danger btn-sm shadow p-0 pr-2 pl-2 rounded" data-toggle="modal" data-target="#modal-default-{{ $id }}">
        <i class="fa fa-trash"></i> Delete
    </button>
@endrole
