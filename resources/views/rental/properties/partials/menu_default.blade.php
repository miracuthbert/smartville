<li>
    <a href="{{ route('rental.properties.index', [$app, 'sort' => 'trashed']) }}">Trashed</a>
</li>
<li>
    <a href="{{ route('rental.properties.index', [$app, 'sort' => 'active']) }}">Active</a>
</li>
<li>
    <a href="{{ route('rental.properties.index', [$app, 'sort' => 'vacant']) }}">Vacant</a>
</li>
<li>
    <a href="{{ route('rental.properties.index', [$app]) }}">All</a>
</li>
