<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Group</th>
            <th>Type</th>
            <th>Size</th>
            <th>Price</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($properties as $property)
            <tr class="{{ $property->status == 1 ? 'info' : '' }}">
                <td>
                    {{ $loop->first ? $properties->firstItem() : ($properties->firstItem() + $loop->index) }}
                </td>
                <td>{{ $property->title }}</td>
                <td>
                    @if($property->property_group != null)
                        @if($property->group != null)
                            {{ $property->group->title }}
                        @endif
                    @else
                        none
                    @endif
                </td>
                <td>{{ $property->property_type == null ? 'none' : $property->type->title }}</td>
                <td>{{ $property->size }}
                    <small>sq.feet</small>
                </td>
                <td>{{ $property->price->price }}</td>
                <td>
                    <span data-toggle="tooltip"
                          title="{{ PropertyStatusText($property->status) }}">
                                        <i class="{{ AppStatusIcon($property->status) }}"></i>
                                    </span>
                </td>
                <td>
                    <div class="btn-group btn-group-xs">
                        @if($sort != "trashed")
                            <a href="{{ route('rental.properties.edit', [$app, $property]) }}"
                               role="button"
                               class="btn btn-primary" data-toggle="tooltip"
                               title="edit property">
                                <i class="fa fa-edit"></i>
                            </a>
                            @if(!$property->status)
                                <a href="{{ route('rental.properties.delete', [$app, $property]) }}"
                                   role="button"
                                   class="btn btn-warning" data-toggle="tooltip"
                                   title="move to trash">
                                    <i class="fa fa-remove"></i>
                                </a>
                            @endif
                            <div class="btn-group">
                                <div class="{{ $loop->last ? 'dropup' : 'dropdown' }}">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false" id="propertyMenu{{ $property->id }}">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu" aria-labelledby="propertyMenu{{ $property->id }}">
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
                                    </ul>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('rental.properties.restore', [$app, $property]) }}"
                               role="button"
                               class="btn btn-success" data-toggle="tooltip"
                               title="restore property">
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a href="{{ route('rental.properties.destroy', [$app, $property]) }}"
                               role="button"
                               class="btn btn-danger" data-toggle="tooltip"
                               title="delete completely">
                                <i class="fa fa-trash"></i>
                            </a>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
