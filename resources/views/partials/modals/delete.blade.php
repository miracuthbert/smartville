<div class="modal fade" id="deleteConfirmation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content panel panel-danger">
            <div class="modal-header panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete confirmation</h4>
            </div>
            <div class="modal-body panel-body">
                <p>Are you sure you want to <b class="text-danger">delete</b> this record?</p>
            </div>
            <div class="modal-footer panel-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id=""
                        onclick="event.preventDefault(); document.getElementById('name-form').submit();">Yes, I
                    do
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
