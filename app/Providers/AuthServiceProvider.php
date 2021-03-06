<?php

namespace App\Providers;

use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Company\CompanyUser;
use App\Policies\CompanyAppPolicy;
use App\Policies\CompanyUserPolicy;
use App\Policies\TenantBillPolicy;
use App\Policies\TenantPolicy;
use App\Models\v1\Tenant\Tenant;
use App\Models\v1\Tenant\TenantBill;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        TenantBill::class => TenantBillPolicy::class,
        Tenant::class => TenantPolicy::class,
        CompanyApp::class => CompanyAppPolicy::class,
        CompanyUser::class => CompanyUserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
