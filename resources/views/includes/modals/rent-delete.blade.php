<div class="modal fade" id="deleteConfirmation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content panel panel-danger">
            <div class="modal-header panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">
                    <i class="fa fa-trash"></i>
                    Delete confirmation
                </h4>
            </div>
            <div class="modal-body panel-body">
                @if($sort == 'trashed')
                    <p>Are you sure you want to <b class="text-danger">remove</b> the selected rent(s) invoices <b
                                class="text-danger">completely</b>?</p>
                @else
                    <p>Are you sure you want to <b class="text-danger">move to trash</b> the selected rent(s) invoices?
                    </p>
                @endif
            </div>
            <div class="modal-footer panel-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id=""
                        onclick="event.preventDefault(); document.getElementById('rent-invoices-form').submit();">
                    Yes, I do
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
