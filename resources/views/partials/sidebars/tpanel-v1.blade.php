<a class="list-group-item {{ ActivePage('tenant.dashboard') }}"
   href="{{ route('tenant.dashboard', ['id' => $tenant->id]) }}">
    <i class="fa fa-dashboard fa-fw"></i> Dashboard
</a>
<a href="{{ route('tenant.leases', ['id' => $tenant->id]) }}" class="list-group-item {{ ActivePage('tenant.leases') }}">
    <i class="fa fa-pencil-square"></i> Leases
</a>
<a class="list-group-item {{ ActivePage('tenant.rents') }}" href="{{ route('tenant.rents', ['id' => $tenant->id]) }}">
    <i class="fa fa-credit-card-alt fa-fw"></i> Rent Invoices
</a>
<a class="list-group-item {{ ActivePage('tenant.bills') }}" href="{{ route('tenant.bills', ['id' => $tenant->id]) }}">
    <i class="fa fa-credit-card fa-fw"></i> Bill Invoices
</a>
<a class="list-group-item" href="{{ route('user.dashboard') }}">
    <i class="fa fa-user fa-fw"></i> My dashboard
</a>
