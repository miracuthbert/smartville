<li>
    <a href="{{ route('rental.properties.index', [$app, 'sort' => 'trashed', 'layout' => 'grid']) }}">In Trash</a>
</li>
<li>
    <a href="{{ route('rental.properties.index', [$app, 'sort' => 'active', 'layout' => 'grid']) }}">Occupied</a>
</li>
<li>
    <a href="{{ route('rental.properties.index', [$app, 'sort' => 'vacant', 'layout' => 'grid']) }}">Vacant</a>
</li>
<li>
    <a href="{{ route('rental.properties.index', [$app, 'layout' => 'grid']) }}">All</a>
</li>
