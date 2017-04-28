<?php

namespace App\Http\Controllers\Admin\Company;

use App\Models\v1\Company\CompanyApp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyAppController extends Controller
{
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

        if ($sort == null)
            $apps = CompanyApp::withCount(['groups', 'properties', 'tenants', 'leases', 'bills', 'rents'])
                ->orderBy('status', 'DESC')
                ->latest()
                ->paginate();
        elseif ($sort == 'subscribed') {
            $apps = collect([]);
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
