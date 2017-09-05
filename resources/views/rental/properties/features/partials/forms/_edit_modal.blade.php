<div class="modal fade" id="feature-edit-modal-{{ $feature->id }}" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Property Feature</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('rental.properties.features.update', [$app, $property, $feature]) }}"
                      id="feature-edit-form-{{ $feature->id }}" method="post">

                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div class="form-group{{ $errors->has('feature') ? ' has-error' : '' }}">
                        <label>Feature</label>
                        <input type="text" name="_feature" class="form-control _add_feature" id="_feature"
                               value="{{ $feature->title }}" required autofocus>
                    </div>
                    <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                        <label>Details</label>
                        <textarea name="_details" rows="3" class="form-control _add_details"
                                  id="_details">{{ $feature->details }}</textarea>
                    </div>
                    <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
                        <label>Total no. of feature</label>
                        <input type="text" name="_value" class="form-control _add_value" id="_value"
                               value="{{ $feature->total_no }}" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnUpdatePropertyFeature"
                        {{ !$app->subscribed != 1 ? 'disabled' : '' }} onclick="event.preventDefault(); document.getElementById('feature-edit-form-{{ $feature->id }}').submit()">
                    Save
                </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->