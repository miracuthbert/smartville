<li>
    <a href="{{ route('estate.rental.properties', ['id' => $app->id, 'sort' => 'trashed', 'layout' => 'grid']) }}">Trashed</a>
</li>
<li>
    <a href="{{ route('estate.rental.properties', ['id' => $app->id, 'sort' => 'active', 'layout' => 'grid']) }}">Active</a>
</li>
<li>
    <a href="{{ route('estate.rental.properties', ['id' => $app->id, 'sort' => 'vacant', 'layout' => 'grid']) }}">Vacant</a>
</li>
<li>
    <a href="{{ route('estate.rental.properties', ['id' => $app->id, 'sort' => 'all', 'layout' => 'grid']) }}">All</a>
</li>
