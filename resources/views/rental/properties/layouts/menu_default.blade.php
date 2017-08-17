<li>
    <a href="{{ route('estate.rental.properties', ['id' => $app->id, 'sort' => 'trashed']) }}">Trashed</a>
</li>
<li>
    <a href="{{ route('estate.rental.properties', ['id' => $app->id, 'sort' => 'active']) }}">Active</a>
</li>
<li>
    <a href="{{ route('estate.rental.properties', ['id' => $app->id, 'sort' => 'vacant']) }}">Vacant</a>
</li>
<li>
    <a href="{{ route('estate.rental.properties', ['id' => $app->id, 'sort' => 'all']) }}">All</a>
</li>
