<?php

namespace App\Http\Controllers\Admin\Company;

use App\Models\v1\Company\AppTrial;
use App\Models\v1\Company\CompanyApp;
use App\Models\v1\Estate\Paypal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyAppController extends Controller
{
    /**
     * CompanyAppController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = $request->sort;
        $trial = $request->on_trial;

        if ($sort == 'subscriptions') {
            $apps = Paypal::with([
                'app' => function ($query) {
                    $query->withCount('properties');
                }
            ])->where('completed', 1)
                ->orderBy('ends_at', '>', 'TODAY()')
                ->paginate();

        } elseif ($sort == 'trials') {
            $apps = AppTrial::with([
                'app' => function ($query) {
                    $query->withCount('properties');
                }
            ])->orderBy('trial_ends_at', 'ASC')
                ->paginate();
        } elseif ($sort == 'subscribed' && $trial == 1) {
            $apps = AppTrial::with([
                'app' => function ($query) {
                    $query->withCount('properties');
                }
            ])->where('trial_ends_at', '>', Carbon::now())
                ->orderBy('trial_ends_at', 'ASC')
                ->paginate();
        } elseif ($sort == 'subscribed' && $trial == 0) {
            $apps = CompanyApp::withCount('properties')
                ->where('subscribed', 1)
                ->where('is_trial', 0)
                ->paginate();
        } else {
            $apps = CompanyApp::withCount(['groups', 'properties', 'tenants', 'leases', 'bills', 'rents'])
                ->orderBy('status', 'DESC')
                ->latest()
                ->paginate();
        }

        return view('v1.admin.company_app.index')
            ->with('apps', $apps)
            ->with('trial', $trial)
            ->with('sort', $sort);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $app = CompanyApp::withCount(['groups', 'properties', 'tenants', 'leases', 'bills', 'rents'])
            ->where('id', $id)->first();

        //check app
        if ($app == null)
            abort(404);

        //authorize
//        $this->authorize('view', $app);

//        dd($app);

        $subscribed = $app->paypal()->where('completed', 1)->where('ends_at', '>', Carbon::now())->first();

        if ($subscribed == null)
            $subscribed = $app->trials()->where('is_ended', 0)->where('trial_ends_at', '>', Carbon::now())->first();

        return view('v1.admin.company_app.show')
            ->with('subscription', $subscribed)
            ->with('app', $app);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
