<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Group</th>
            <th>Type</th>
            <th>Size</th>
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
                <td>
                    <span data-toggle="tooltip"
                          title="{{ PropertyStatusText($property->status) }}">
                                        <i class="{{ AppStatusIcon($property->status) }}"></i>
                                    </span>
                </td>
                <td>
                    <div class="btn-group btn-group-xs">
                        @if($sort != "trashed")
                            <a href="{{ route('estate.rental.property.edit', ['id' => $property->id]) }}"
                               role="button"
                               class="btn btn-primary" data-toggle="tooltip"
                               title="edit property">
                                <i class="fa fa-edit"></i>
                            </a>
                            @if(!$property->status)
                                <a href="{{ route('estate.rental.property.delete', ['id' => $property->id]) }}"
                                   role="button"
                                   class="btn btn-warning" data-toggle="tooltip"
                                   title="move to trash">
                                    <i class="fa fa-remove"></i>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('estate.rental.property.restore', ['id' => $property->id]) }}"
                               role="button"
                               class="btn btn-success" data-toggle="tooltip"
                               title="restore property">
                                <i class="fa fa-refresh"></i>
                            </a>
                            <a href="{{ route('estate.rental.property.destroy', ['id' => $property->id]) }}"
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
