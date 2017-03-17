@foreach($properties->chunk(3) as $_properties)
    <div class="row">
        @foreach($_properties as $property)
            <div class="col-lg-4 col-sm-6">
                <div class="panel panel-{{ $property->status == 1 ? 'success' : 'default' }}">
                    <div class="panel-heading clearfix">
                        <strong>{{ $property->title }}</strong>
                        <div class="pull-right">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-default dropdown-toggle"
                                        data-toggle="dropdown" aria-expanded="false">
                                    <strong>
                                        Actions
                                        <i class="caret"></i>
                                    </strong>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    @if($sort != "trashed")
                                        <li>
                                            <a href="{{ route('estate.property.delete', ['id' => $property->id]) }}"
                                               role="button" class="" data-toggle="tooltip"
                                               title="move to trash">
                                                Move To Trash
                                            </a>
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ route('estate.property.restore', ['id' => $property->id]) }}"
                                               role="button" class=""
                                               data-toggle="tooltip" title="restore property">
                                                Restore Property
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('estate.property.destroy', ['id' => $property->id]) }}"
                                               role="button" class=""
                                               data-toggle="tooltip" title="delete completely">
                                                Delete Completely
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <p class="">Status:
                            <small>{{ PropertyStatusText($property->status) }}</small>
                        </p>
                    </div>
                    <a href="{{ route('estate.property.edit', ['id' => $property->id]) }}"
                       role="button" class="" data-toggle="tooltip" title="view or edit property">
                        <div class="panel-footer">
                            View/Edit
                            <i class="fa fa-chevron-right pull-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endforeach
