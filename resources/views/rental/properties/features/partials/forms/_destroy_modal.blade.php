<div class="modal fade" id="property-feature-destroy-modal-{{ $feature->id }}" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content panel panel-danger">
            <div class="modal-header panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-trash-o"></i> Delete Completely Property Feature</h4>
            </div>
            <div class="modal-body panel-body">
                <form action="{{ route('rental.properties.features.destroy', [$app, $property, $feature]) }}"
                      id="property-feature-destroy-{{ $feature->id }}-form" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
                <p class="text-danger">Are you sure you want to <strong>delete completely</strong> `{{ $feature->title }}` feature?</p>
                <strong class="text-danger"> <i class="fa fa-warning"></i> Warning: You cannot undo this action once completed.</strong>
            </div>
            <div class="modal-footer panel-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger"
                        {{ !$app->subscribed != 1 ? 'disabled' : '' }} onclick="event.preventDefault(); document.getElementById('property-feature-destroy-{{ $feature->id }}-form').submit()">
                    <i class="fa fa-trash-o"></i> Delete
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->