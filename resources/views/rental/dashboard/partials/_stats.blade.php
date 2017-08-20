<div class="row">
    <div class="col-md-6"><!-- panel primary -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-4">
                        <i class="fa fa-home fa-5x"></i>
                    </div>
                    <div class="col-sm-8 text-right">
                        <div class="huge">{{ $properties->total() }}</div>
                        <div>Properties</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('rental.properties.index', ['id' => $app->id, 'sort' => 'all']) }}" class="">
                <div class="panel-footer">
                    View all
                    <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-6"><!-- panel green -->
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-4">
                        <i class="fa fa-users fa-5x"></i>
                    </div>
                    <div class="col-sm-8 text-right">
                        <div class="huge">{{ $tenants->total() }}</div>
                        <div>Tenants(Leases)</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('rental.tenants.index', [$app, 'sort' => 'all', 'leases' => 1]) }}"
               class="">
                <div class="panel-footer">
                    View all
                    <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-6"><!-- panel red -->
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-4">
                        <i class="fa fa-money fa-5x"></i>
                    </div>
                    <div class="col-sm-8 text-right">
                        <div class="huge">{{ $pm_bills->total() }}</div>
                        <div class="small">Pending Bills/Month</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('rental.bills.index', [$app, 'sort' => 'pending', 'month' => 1]) }}"
               class="">
                <div class="panel-footer">
                    View all
                    <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
                </div>
            </a>
        </div>
    </div>
    <div class="col-md-6"><!-- panel yellow -->
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-4">
                        <i class="fa fa-credit-card fa-5x"></i>
                    </div>
                    <div class="col-sm-8 text-right">
                        <div class="huge">{{ $pm_rents->total() }}</div>
                        <div class="small">Pending Rent/Month</div>
                    </div>
                </div>
            </div>
            <a href="{{ route('rental.rents.index', [$app, 'sort' => 'pending', 'month' => 1]) }}"
               class="">
                <div class="panel-footer">
                    View all
                    <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
                </div>
            </a>
        </div>
    </div>
</div>