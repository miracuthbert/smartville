<div class="modal fade" id="property-feature-delete-modal-{{ $feature->id }}" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content panel panel-warning">
            <div class="modal-header panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Property Feature</h4>
            </div>
            <div class="modal-body panel-body">
                <form action="{{ route('rental.properties.features.delete', [$app, $property, $feature]) }}"
                      id="property-feature-delete-{{ $feature->id }}-form" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                </form>
                <p class="text-danger">Are you sure you want to move this `{{ $feature->title }}` feature to trash?</p>
            </div>
            <div class="modal-footer panel-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning"
                        {{ !$app->subscribed != 1 ? 'disabled' : '' }} onclick="event.preventDefault(); document.getElementById('property-feature-delete-{{ $feature->id }}-form').submit()">
                    Delete
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->