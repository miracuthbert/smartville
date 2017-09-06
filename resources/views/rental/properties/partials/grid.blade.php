@foreach($properties->chunk(3) as $_properties)
    <div class="row">
        @foreach($_properties as $property)
            <div class="col-lg-4 col-sm-6">
                <div class="panel panel-{{ $property->status == 1 ? 'green' : 'default' }}">
                    <div class="panel-heading clearfix">
                        <strong>{{ $property->title }}</strong>
                        <div class="pull-right">
                            <div class="btn-group btn-group-xs">
                                <div class="{{ $loop->last ? 'dropup' : 'dropdown' }}">
                                    <button class="btn btn-default btn-xs dropdown-toggle"
                                            data-toggle="dropdown" aria-expanded="false">
                                        <strong><i class="fa fa-ellipsis-v"></i></strong>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        @if($sort != "trashed")
                                            @if(!$property->status)
                                                <li>
                                                    <a href="{{ route('rental.properties.delete', [$app, $property]) }}"
                                                       role="button" class="" data-toggle="tooltip"
                                                       title="move to trash">
                                                        Move To Trash
                                                    </a>
                                                </li>
                                            @endif
                                            <li>
                                                <a href="{{ route('rental.properties.amenities.index', [$app, $property]) }}">
                                                    Property Amenities
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('rental.properties.features.index', [$app, $property]) }}">
                                                    Property Features
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('rental.properties.gallery.index', [$app, $property]) }}">
                                                    Property Galleries
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ route('rental.properties.restore', [$app, $property]) }}"
                                                   role="button" class=""
                                                   data-toggle="tooltip" title="restore property">
                                                    Restore Property
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ route('rental.properties.destroy', [$app, $property]) }}"
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
                        <a href="{{ route('rental.properties.edit', [$app, $property]) }}"
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
