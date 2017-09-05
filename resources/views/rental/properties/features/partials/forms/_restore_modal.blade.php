<div class="modal fade" id="property-feature-restore-modal-{{ $feature->id }}" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content panel panel-success">
            <div class="modal-header panel-heading">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-restore"></i> Restore Property Feature</h4>
            </div>
            <div class="modal-body panel-body">
                <form action="{{ route('rental.properties.features.restore', [$app, $property, $feature]) }}"
                      id="property-feature-restore-{{ $feature->id }}-form" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                </form>
                <p class="text-success">Are you sure you want to <strong>restore</strong> `{{ $feature->title }}` feature?</p>
            </div>
            <div class="modal-footer panel-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success"
                        {{ !$app->subscribed != 1 ? 'disabled' : '' }} onclick="event.preventDefault(); document.getElementById('property-feature-restore-{{ $feature->id }}-form').submit()">
                    <i class="fa fa-refresh"></i> Restore
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->