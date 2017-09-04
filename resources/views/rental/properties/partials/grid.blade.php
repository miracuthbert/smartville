@foreach($properties->chunk(3) as $_properties)
    <div class="row">
        @foreach($_properties as $property)
            <div class="col-lg-4 col-sm-6">
                <div class="panel panel-{{ $property->status == 1 ? 'green' : 'default' }}">
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
                                        @if(!$property->status)
                                            <li>
                                                <a href="{{ route('estate.rental.property.delete', ['id' => $property->id]) }}"
                                                   role="button" class="" data-toggle="tooltip"
                                                   title="move to trash">
                                                    Move To Trash
                                                </a>
                                            </li>
                                        @else
                                            <li class="dropdown-header">No options available</li>
                                        @endif
                                    @else
                                        <li>
                                            <a href="{{ route('estate.rental.property.restore', ['id' => $property->id]) }}"
                                               role="button" class=""
                                               data-toggle="tooltip" title="restore property">
                                                Restore Property
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('estate.rental.property.destroy', ['id' => $property->id]) }}"
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
                        <p class="property-status">
                            <strong>Status:</strong>
                            <span class="{{ PropertyStatusLabel($property->status) }}">
                                {{ PropertyStatusText($property->status) }}
                            </span>
                        </p>
                        <strong class="text-success">{{ $sort == "trashed" ? 'Restore property for more options' : '' }}</strong>
                    </div>
                    @if($sort != "trashed")
                        <a href="{{ route('estate.rental.property.edit', ['id' => $property->id]) }}"
                           role="button" class="" data-toggle="tooltip" title="view or edit property">
                            <div class="panel-footer">
                                View/Edit
                                <i class="fa fa-chevron-right pull-right"></i>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endforeach
