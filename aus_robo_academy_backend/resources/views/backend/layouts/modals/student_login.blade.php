
<form action="{{ route('student.programs.index', ['organisation_id' => request()->organisation_id]) }}"
    method="get">
    <div class="modal fade bg-gradient-danger" id="modal-student">
        <div class="modal-dialog modal-dialog-centered text-center">
            <div class="modal-content bg-gradient-warning">
                <x-card header="false" footer="false">
                    <img src="{{ URL::asset('/admin/dist/img/logo.png') }}" height="150"
                        alt="AU Robo Academy Logo">
                    <h3 class="mt-2 mb-1 text-dark">Organisation ID</h3>
                    <div class="input-group mb-3 pl-5 pr-5">
                        <input type="text" name="organisation_id" id="organisation_id"
                            class="form-control text-center"
                            placeholder="Please Provide Organisation ID">
                    </div>
                    <button type="button" class="btn btn-success rounded-pill"
                        data-dismiss="modal">
                        <i class="fa fa-times"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger rounded-pill">
                        Proceed
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </x-card>
            </div>
        </div>
    </div>
</form>
