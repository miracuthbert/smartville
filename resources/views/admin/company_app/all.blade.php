<table class="table table-bordered table-hover">
    <caption>
        <h3>
            <i class="fa fa-credit-card"></i>
            All
        </h3>
    </caption>
    <thead>
    <tr>
        <td>Company</td>
        <td>Ends At</td>
        <td>Status</td>
        <td>Actions</td>
    </tr>
    </thead><!-- /thead -->
    <tbody>
    @forelse($apps as $app)
        <tr>
            <td>
                <h5 class="lead">
                    {{ $loop->first ? $apps->firstItem() : ($apps->firstItem() + $loop->index) }}.
                    {{ $app->company->title }}
                    <span class="badge" data-toggle="tooltip" title="properties"
                          role="button">
                        {{ $app->properties_count }}
                    </span>
                </h5>
                <p class="small">{{ $app->product->title }}</p>
            </td>
            <td>
                <p class="text-muted strong">
                    @if($app->subscribed && $app->is_trial == 0 && $app->paypal_active()->first())
                        {{ $app->paypal_active()->first() ? $app->paypal_active()->first()->ends_at->toDayDateTimeString() : '' }}
                    @endif
                    @if($app->subscribed && $app->is_trial == 1 && $app->trials->first())
                        {{ $app->trials->first()->trial_ends_at->toDayDateTimeString() }}
                    @endif
                </p>
            </td>
            <td>
                @if($app->subscribed && $app->is_trial == 0 && $app->paypal_active()->first())
                    <p class="{{ SubscriptionStatusLabel($app->paypal_active()->first()->ends_at) }}">
                        <span data-toggle="tooltip"
                              title="{{ SubscriptionStatusText($app->paypal_active()->first()->ends_at) }}">
                              {{ SubscriptionStatusText($app->paypal_active()->first()->ends_at) }}
                            <i class="{{ SubscriptionStatusIcon($app->paypal_active()->first()->ends_at) }}"></i>
                        </span>
                    </p>
                @elseif($app->subscribed && $app->is_trial == 1 && $app->trials->first())
                    <p class="{{ SubscriptionStatusLabel($app->trials->first()->trial_ends_at) }}">
                        <span data-toggle="tooltip"
                              title="{{ SubscriptionStatusText($app->trials->first()->trial_ends_at) }}">
                              {{ SubscriptionStatusText($app->trials->first()->trial_ends_at) }}
                            <i class="{{ SubscriptionStatusIcon($app->trials->first()->trial_ends_at) }}"></i>
                        </span>
                    </p>
                @else
                    <p>
                        Not Subscribed
                    </p>
                @endif
            </td>
            <td>
                <div class="pull-right">
                    <div class="btn-group btn-group-sm">
                        <button type="button" class="btn btn-default dropdown-toggle"
                                data-toggle="dropdown">
                            Actions <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="{{ route('admin_company_app.show', ['admin_company_app' => $app->id]) }}">
                                    View <i class="fa fa-eye"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4">
                <h4 class="list-group-text">
                    No company apps.
                </h4>
            </td>
        </tr>
    @endforelse
    </tbody><!-- /tbody -->
</table><!-- /.table -->
