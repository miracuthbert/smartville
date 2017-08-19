<div class="row">
    <div class="col-xs-6 col-sm-3"><!-- panel primary -->
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
            <a href="{{ route('estate.rental.properties', ['id' => $app->id, 'sort' => 'all']) }}" class="">
                <div class="panel-footer">
                    View all
                    <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xs-6 col-sm-3"><!-- panel green -->
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
            <a href="{{ route('estate.rental.tenants', ['id' => $app->id, 'sort' => 'all', 'leases' => 1]) }}"
               class="">
                <div class="panel-footer">
                    View all
                    <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xs-6 col-sm-3"><!-- panel red -->
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
            <a href="{{ route('estate.rental.bills.tenants', ['id' => $app->id, 'sort' => 'pending', 'month' => 1]) }}"
               class="">
                <div class="panel-footer">
                    View all
                    <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
                </div>
            </a>
        </div>
    </div>
    <div class="col-xs-6 col-sm-3"><!-- panel yellow -->
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
            <a href="{{ route('estate.rental.rents', ['id' => $app->id, 'sort' => 'pending', 'month' => 1]) }}"
               class="">
                <div class="panel-footer">
                    View all
                    <span class="glyphicon glyphicon-circle-arrow-right pull-right"></span>
                </div>
            </a>
        </div>
    </div>
</div>