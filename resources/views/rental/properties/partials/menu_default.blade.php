<li>
    <a href="{{ route('rental.properties.index', [$app, 'sort' => 'trashed']) }}">In Trash</a>
</li>
<li>
    <a href="{{ route('rental.properties.index', [$app, 'sort' => 'active']) }}">Occupied</a>
</li>
<li>
    <a href="{{ route('rental.properties.index', [$app, 'sort' => 'vacant']) }}">Vacant</a>
</li>
<li>
    <a href="{{ route('rental.properties.index', [$app]) }}">All</a>
</li>
