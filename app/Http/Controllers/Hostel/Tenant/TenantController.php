<?php

namespace App\Http\Controllers\Hostel\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Countries;
use ExtCountries;

class TenantController extends Controller
{
    /**
     * TenantController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param $app
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $app)
    {
        //find company app
        $app = CompanyApp::findOrFail($app);

        return view('hostels.tenants.index')
            ->with('app', $app);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $app
     * @return \Illuminate\Http\Response
     */
    public function create($app)
    {
        //find company app
        $app = CompanyApp::findOrFail($app);

        //get the list of countries
        $countries = Countries::getList('en', 'php');

        return view('hostels.tenants.create')
            ->with('countries', $countries)
            ->with('app', $app);
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
        return view('hostels.tenants.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('hostels.tenants.edit');
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
