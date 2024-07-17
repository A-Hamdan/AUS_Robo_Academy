<div class="modal fade bg-" id="modal-default-{{ $id }}">
    <div class="modal-dialog text-center">
        <div class="modal-content" style="background-image: linear-gradient(#F8E177, #54B593);">
            <x-card header="true" footer="false" headerTitle="Confirm Delete">
                <img src="{{ URL::asset('/admin/dist/img/logo.png') }}" height="150" alt="AU Robo Academy Logo">
                <h3 class="mt-2 mb-3">Are You Sure to Delete?</h3>
                <button type="button" class="btn btn-success rounded-pill" data-dismiss="modal">Cancel</button>
                <a href="{{ route($delete,$id) }}">
                    <button type="submit" class="btn btn-danger rounded-pill">Yes, Delete it</button>
                </a>
            </x-card>
        </div>
    </div>
</div>
