<form action="{{ route('student.model.steps.index') }}" method="get" target="_blank" onsubmit="closeModal()">
    <div class="modal fade bg-gradient-info" id="passcode">
        <div class="modal-dialog modal-dialog-centered text-center">
            <div class="modal-content bg-gradient-warning">
                <x-card header="false" footer="false">
                    <img src="{{ URL::asset('/admin/dist/img/logo.png') }}" height="150" alt="AU Robo Academy Logo">
                    <h3 class="mt-2 mb-1 text-dark">Passcode</h3>
                    <div class="form-group pr-5 pl-5">
                        <input type="hidden" name="model_id" id="model_id" value="">
                        <input type="text" name="passcode" id="passcode" class="form-control text-center" placeholder="Please Enter Passcode">
                    </div>
                    <button type="button" class="btn btn-success rounded-pill" data-dismiss="modal">
                        <i class="fa fa-times"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger rounded-pill">
                        Continue
                        <i class="fa fa-arrow-right"></i>
                    </button>
                </x-card>
            </div>
        </div>
    </div>
</form>

<script>
    function closeModal() {
        $('#passcode').modal('hide');
    }
</script>
